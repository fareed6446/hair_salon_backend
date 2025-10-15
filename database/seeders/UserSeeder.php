<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update admin user
        User::updateOrCreate(
            ['phone' => '+923001234567'],
            [
                'name' => 'Admin User',
                'full_name' => 'Admin User',
                'email' => 'admin@hairsalon.com',
                'password' => Hash::make('password'),
                'loyalty_points' => 0,
            ]
        );

        // Create or update sample customers
        User::updateOrCreate(
            ['phone' => '+923001234568'],
            [
                'name' => 'Sarah Ahmed',
                'full_name' => 'Sarah Ahmed',
                'email' => 'sarah@example.com',
                'password' => Hash::make('password'),
                'loyalty_points' => 150,
            ]
        );

        User::updateOrCreate(
            ['phone' => '+923001234569'],
            [
                'name' => 'Fatima Khan',
                'full_name' => 'Fatima Khan',
                'email' => 'fatima@example.com',
                'password' => Hash::make('password'),
                'loyalty_points' => 75,
            ]
        );

        User::updateOrCreate(
            ['phone' => '+923001234570'],
            [
                'name' => 'Ayesha Malik',
                'full_name' => 'Ayesha Malik',
                'email' => 'ayesha@example.com',
                'password' => Hash::make('password'),
                'loyalty_points' => 200,
            ]
        );

        User::updateOrCreate(
            ['phone' => '+923001234571'],
            [
                'name' => 'Zara Sheikh',
                'full_name' => 'Zara Sheikh',
                'email' => 'zara@example.com',
                'password' => Hash::make('password'),
                'loyalty_points' => 50,
            ]
        );
    }
}