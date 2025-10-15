<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio',
        'specialization',
        'rating',
        'total_reviews',
        'image_url',
        'is_active',
        'working_hours',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'total_reviews' => 'integer',
        'is_active' => 'boolean',
        'working_hours' => 'array',
    ];

    /**
     * Get the bookings for the stylist.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the time slots for the stylist.
     */
    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }

    /**
     * Scope a query to only include active stylists.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Update rating based on reviews.
     */
    public function updateRating($newRating)
    {
        $totalRating = ($this->rating * $this->total_reviews) + $newRating;
        $this->total_reviews += 1;
        $this->rating = $totalRating / $this->total_reviews;
        $this->save();
    }
}