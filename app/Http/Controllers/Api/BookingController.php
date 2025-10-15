<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\LoyaltyTransaction;
use App\Models\Notification;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Create a new booking.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
            'package_id' => 'nullable|exists:service_packages,id',
            'stylist_id' => 'nullable|exists:stylists,id',
            'date_time' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = auth()->user();
        $service = Service::findOrFail($request->service_id);
        $package = $request->package_id ? ServicePackage::findOrFail($request->package_id) : null;
        $stylist = $request->stylist_id ? Stylist::findOrFail($request->stylist_id) : null;

        // Calculate loyalty points (1 point per 100 PKR)
        $price = $package ? $package->price : $service->base_price;
        $loyaltyPoints = floor($price / 100);

        $booking = Booking::create([
            'user_id' => $user->id,
            'service_id' => $request->service_id,
            'package_id' => $request->package_id,
            'stylist_id' => $request->stylist_id,
            'date_time' => $request->date_time,
            'notes' => $request->notes,
            'loyalty_points_awarded' => $loyaltyPoints,
        ]);

        // Update user loyalty points
        $user->increment('loyalty_points', $loyaltyPoints);

        // Create loyalty transaction
        LoyaltyTransaction::create([
            'user_id' => $user->id,
            'type' => 'earned',
            'points' => $loyaltyPoints,
            'description' => 'Points earned from booking: ' . $service->title,
            'booking_id' => $booking->id,
        ]);

        // Create notification
        Notification::create([
            'user_id' => $user->id,
            'type' => 'booking_confirmation',
            'title' => 'Booking Confirmed',
            'message' => 'Your booking for ' . $service->title . ' has been confirmed for ' . $booking->date_time->format('M d, Y \a\t h:i A'),
            'data' => [
                'booking_id' => $booking->id,
                'service_title' => $service->title,
                'date_time' => $booking->date_time->toISOString(),
            ],
        ]);

        $booking->load(['service', 'package', 'stylist']);

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully',
            'data' => $booking,
        ], 201);
    }

    /**
     * Get user's bookings.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $status = $request->get('status', 'all');

        $query = $user->bookings()->with(['service', 'package', 'stylist']);

        switch ($status) {
            case 'upcoming':
                $query->upcoming();
                break;
            case 'past':
                $query->past();
                break;
            case 'cancelled':
                $query->cancelled();
                break;
        }

        $bookings = $query->orderBy('date_time', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $bookings,
        ]);
    }

    /**
     * Get a specific booking.
     */
    public function show($id)
    {
        $user = auth()->user();
        $booking = $user->bookings()
            ->with(['service', 'package', 'stylist'])
            ->find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $booking,
        ]);
    }

    /**
     * Cancel a booking.
     */
    public function cancel($id)
    {
        $user = auth()->user();
        $booking = $user->bookings()->find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        }

        if ($booking->status !== 'booked') {
            return response()->json([
                'success' => false,
                'message' => 'Only booked appointments can be cancelled'
            ], 400);
        }

        if ($booking->date_time <= now()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot cancel past appointments'
            ], 400);
        }

        // Deduct loyalty points if they were awarded
        if ($booking->loyalty_points_awarded > 0) {
            $user->decrement('loyalty_points', $booking->loyalty_points_awarded);

            // Create loyalty transaction for deduction
            LoyaltyTransaction::create([
                'user_id' => $user->id,
                'type' => 'redeemed',
                'points' => -$booking->loyalty_points_awarded,
                'description' => 'Points deducted due to booking cancellation',
                'booking_id' => $booking->id,
            ]);
        }

        $booking->update(['status' => 'cancelled']);

        // Create notification
        Notification::create([
            'user_id' => $user->id,
            'type' => 'booking_cancellation',
            'title' => 'Booking Cancelled',
            'message' => 'Your booking for ' . $booking->service->title . ' has been cancelled',
            'data' => [
                'booking_id' => $booking->id,
                'service_title' => $booking->service->title,
            ],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking cancelled successfully',
            'data' => $booking,
        ]);
    }
}