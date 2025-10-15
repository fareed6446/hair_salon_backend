<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimeSlotController extends Controller
{
    /**
     * Get available time slots for a service and date.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after_or_equal:today',
            'stylist_id' => 'nullable|exists:stylists,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $query = TimeSlot::available()
            ->forDate($request->date)
            ->future();

        if ($request->stylist_id) {
            $query->where('stylist_id', $request->stylist_id);
        }

        $timeSlots = $query->with('stylist')
            ->orderBy('start_time')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $timeSlots,
        ]);
    }
}