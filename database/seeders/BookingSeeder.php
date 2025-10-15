<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\LoyaltyTransaction;
use App\Models\Notification;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\Stylist;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('email', '!=', 'admin@hairsalon.com')->get();
        $services = Service::all();
        $stylists = Stylist::all();

        // Create some past bookings
        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) {
                $service = $services->random();
                $package = $service->packages->random();
                $stylist = $stylists->random();
                
                $dateTime = now()->subDays(rand(1, 30))->setTime(rand(9, 17), rand(0, 1) * 30);
                
                $booking = Booking::create([
                    'user_id' => $user->id,
                    'service_id' => $service->id,
                    'package_id' => $package->id,
                    'stylist_id' => $stylist->id,
                    'date_time' => $dateTime,
                    'status' => 'completed',
                    'loyalty_points_awarded' => floor($package->price / 100),
                    'notes' => 'Regular appointment',
                ]);

                // Create loyalty transaction
                LoyaltyTransaction::create([
                    'user_id' => $user->id,
                    'type' => 'earned',
                    'points' => $booking->loyalty_points_awarded,
                    'description' => 'Points earned from booking: ' . $service->title,
                    'booking_id' => $booking->id,
                ]);

                // Create notification
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'booking_confirmation',
                    'title' => 'Booking Confirmed',
                    'message' => 'Your booking for ' . $service->title . ' has been confirmed for ' . $booking->date_time->format('M d, Y \a\t h:i A'),
                    'is_read' => true,
                    'data' => [
                        'booking_id' => $booking->id,
                        'service_title' => $service->title,
                        'date_time' => $booking->date_time->toISOString(),
                    ],
                ]);
            }
        }

        // Create some upcoming bookings
        foreach ($users->take(3) as $user) {
            $service = $services->random();
            $package = $service->packages->random();
            $stylist = $stylists->random();
            
            $dateTime = now()->addDays(rand(1, 14))->setTime(rand(9, 17), rand(0, 1) * 30);
            
            $booking = Booking::create([
                'user_id' => $user->id,
                'service_id' => $service->id,
                'package_id' => $package->id,
                'stylist_id' => $stylist->id,
                'date_time' => $dateTime,
                'status' => 'booked',
                'loyalty_points_awarded' => 0, // Will be awarded after completion
                'notes' => 'Upcoming appointment',
            ]);

            // Create notification
            Notification::create([
                'user_id' => $user->id,
                'type' => 'booking_confirmation',
                'title' => 'Booking Confirmed',
                'message' => 'Your booking for ' . $service->title . ' has been confirmed for ' . $booking->date_time->format('M d, Y \a\t h:i A'),
                'is_read' => false,
                'data' => [
                    'booking_id' => $booking->id,
                    'service_title' => $service->title,
                    'date_time' => $booking->date_time->toISOString(),
                ],
            ]);
        }

        // Create some promotional notifications
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'promotional',
                'title' => 'Special Offer!',
                'message' => 'Get 20% off on all hair coloring services this month!',
                'is_read' => false,
                'data' => [
                    'discount' => 20,
                    'service_type' => 'hair_coloring',
                ],
            ]);
        }
    }
}