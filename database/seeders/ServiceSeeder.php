<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hair Cut Service
        $hairCut = Service::create([
            'title' => 'Hair Cut',
            'description' => 'Professional hair cutting service with modern techniques and styles.',
            'base_price' => 1500.00,
            'duration_minutes' => 45,
            'image_url' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=500',
            'category_id' => 'hair',
            'is_active' => true,
        ]);

        ServicePackage::create([
            'service_id' => $hairCut->id,
            'name' => 'Basic Cut',
            'price' => 1500.00,
            'duration_minutes' => 45,
            'details' => 'Basic hair cutting service',
        ]);

        ServicePackage::create([
            'service_id' => $hairCut->id,
            'name' => 'Premium Cut',
            'price' => 2500.00,
            'duration_minutes' => 60,
            'details' => 'Premium hair cutting with styling and consultation',
        ]);

        // Hair Color Service
        $hairColor = Service::create([
            'title' => 'Hair Color',
            'description' => 'Professional hair coloring with premium products and techniques.',
            'base_price' => 3000.00,
            'duration_minutes' => 120,
            'image_url' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=500',
            'category_id' => 'color',
            'is_active' => true,
        ]);

        ServicePackage::create([
            'service_id' => $hairColor->id,
            'name' => 'Root Touch-up',
            'price' => 3000.00,
            'duration_minutes' => 120,
            'details' => 'Root touch-up coloring service',
        ]);

        ServicePackage::create([
            'service_id' => $hairColor->id,
            'name' => 'Full Color',
            'price' => 5000.00,
            'duration_minutes' => 180,
            'details' => 'Complete hair coloring service',
        ]);

        // Hair Styling Service
        $hairStyling = Service::create([
            'title' => 'Hair Styling',
            'description' => 'Professional hair styling for special occasions and events.',
            'base_price' => 2000.00,
            'duration_minutes' => 90,
            'image_url' => 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=500',
            'category_id' => 'styling',
            'is_active' => true,
        ]);

        ServicePackage::create([
            'service_id' => $hairStyling->id,
            'name' => 'Basic Styling',
            'price' => 2000.00,
            'duration_minutes' => 90,
            'details' => 'Basic hair styling service',
        ]);

        ServicePackage::create([
            'service_id' => $hairStyling->id,
            'name' => 'Bridal Styling',
            'price' => 8000.00,
            'duration_minutes' => 240,
            'details' => 'Special bridal hair styling with trial',
        ]);

        // Facial Service
        $facial = Service::create([
            'title' => 'Facial Treatment',
            'description' => 'Relaxing facial treatment with premium skincare products.',
            'base_price' => 2500.00,
            'duration_minutes' => 75,
            'image_url' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=500',
            'category_id' => 'facial',
            'is_active' => true,
        ]);

        ServicePackage::create([
            'service_id' => $facial->id,
            'name' => 'Basic Facial',
            'price' => 2500.00,
            'duration_minutes' => 75,
            'details' => 'Basic facial cleansing and moisturizing',
        ]);

        ServicePackage::create([
            'service_id' => $facial->id,
            'name' => 'Gold Facial',
            'price' => 4000.00,
            'duration_minutes' => 90,
            'details' => 'Premium gold facial treatment',
        ]);

        // Manicure Service
        $manicure = Service::create([
            'title' => 'Manicure',
            'description' => 'Professional nail care and manicure service.',
            'base_price' => 1200.00,
            'duration_minutes' => 60,
            'image_url' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=500',
            'category_id' => 'nails',
            'is_active' => true,
        ]);

        ServicePackage::create([
            'service_id' => $manicure->id,
            'name' => 'Basic Manicure',
            'price' => 1200.00,
            'duration_minutes' => 60,
            'details' => 'Basic nail care and polish',
        ]);

        ServicePackage::create([
            'service_id' => $manicure->id,
            'name' => 'Gel Manicure',
            'price' => 2000.00,
            'duration_minutes' => 75,
            'details' => 'Gel nail polish application',
        ]);
    }
}