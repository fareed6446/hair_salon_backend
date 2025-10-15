<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'points',
        'description',
        'booking_id',
    ];

    protected $casts = [
        'points' => 'integer',
    ];

    /**
     * Get the user that owns the loyalty transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the booking for the loyalty transaction.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Scope a query to only include earned transactions.
     */
    public function scopeEarned($query)
    {
        return $query->where('type', 'earned');
    }

    /**
     * Scope a query to only include redeemed transactions.
     */
    public function scopeRedeemed($query)
    {
        return $query->where('type', 'redeemed');
    }
}