<?php

namespace Database\Seeders;

use App\Models\Stylist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stylist::create([
            'name' => 'Amina Khan',
            'bio' => 'Experienced hair stylist with 8 years of expertise in modern cuts and coloring techniques.',
            'specialization' => 'Hair Cutting & Coloring',
            'rating' => 4.8,
            'total_reviews' => 150,
            'image_url' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=300',
            'is_active' => true,
            'working_hours' => [
                'monday' => ['09:00', '18:00'],
                'tuesday' => ['09:00', '18:00'],
                'wednesday' => ['09:00', '18:00'],
                'thursday' => ['09:00', '18:00'],
                'friday' => ['09:00', '18:00'],
                'saturday' => ['10:00', '16:00'],
                'sunday' => ['closed'],
            ],
        ]);

        Stylist::create([
            'name' => 'Sana Ali',
            'bio' => 'Specialized in bridal styling and special occasion hair designs with 6 years of experience.',
            'specialization' => 'Bridal & Special Occasion Styling',
            'rating' => 4.9,
            'total_reviews' => 200,
            'image_url' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=300',
            'is_active' => true,
            'working_hours' => [
                'monday' => ['10:00', '19:00'],
                'tuesday' => ['10:00', '19:00'],
                'wednesday' => ['10:00', '19:00'],
                'thursday' => ['10:00', '19:00'],
                'friday' => ['10:00', '19:00'],
                'saturday' => ['09:00', '17:00'],
                'sunday' => ['closed'],
            ],
        ]);

        Stylist::create([
            'name' => 'Fatima Sheikh',
            'bio' => 'Expert in hair coloring and chemical treatments with 10 years of professional experience.',
            'specialization' => 'Hair Coloring & Chemical Treatments',
            'rating' => 4.7,
            'total_reviews' => 180,
            'image_url' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=300',
            'is_active' => true,
            'working_hours' => [
                'monday' => ['08:00', '17:00'],
                'tuesday' => ['08:00', '17:00'],
                'wednesday' => ['08:00', '17:00'],
                'thursday' => ['08:00', '17:00'],
                'friday' => ['08:00', '17:00'],
                'saturday' => ['09:00', '15:00'],
                'sunday' => ['closed'],
            ],
        ]);

        Stylist::create([
            'name' => 'Zara Malik',
            'bio' => 'Skilled in facial treatments and skincare with certification in advanced beauty techniques.',
            'specialization' => 'Facial Treatments & Skincare',
            'rating' => 4.6,
            'total_reviews' => 120,
            'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300',
            'is_active' => true,
            'working_hours' => [
                'monday' => ['11:00', '20:00'],
                'tuesday' => ['11:00', '20:00'],
                'wednesday' => ['11:00', '20:00'],
                'thursday' => ['11:00', '20:00'],
                'friday' => ['11:00', '20:00'],
                'saturday' => ['10:00', '18:00'],
                'sunday' => ['closed'],
            ],
        ]);

        Stylist::create([
            'name' => 'Hina Ahmed',
            'bio' => 'Professional nail technician specializing in manicures, pedicures, and nail art.',
            'specialization' => 'Nail Care & Art',
            'rating' => 4.5,
            'total_reviews' => 95,
            'image_url' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=300',
            'is_active' => true,
            'working_hours' => [
                'monday' => ['09:00', '18:00'],
                'tuesday' => ['09:00', '18:00'],
                'wednesday' => ['09:00', '18:00'],
                'thursday' => ['09:00', '18:00'],
                'friday' => ['09:00', '18:00'],
                'saturday' => ['10:00', '16:00'],
                'sunday' => ['closed'],
            ],
        ]);
    }
}