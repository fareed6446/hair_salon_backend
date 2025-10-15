<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'package_id',
        'stylist_id',
        'date_time',
        'status',
        'loyalty_points_awarded',
        'notes',
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'loyalty_points_awarded' => 'integer',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the service for the booking.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the package for the booking.
     */
    public function package()
    {
        return $this->belongsTo(ServicePackage::class, 'package_id');
    }

    /**
     * Get the stylist for the booking.
     */
    public function stylist()
    {
        return $this->belongsTo(Stylist::class);
    }

    /**
     * Get the loyalty transaction for the booking.
     */
    public function loyaltyTransaction()
    {
        return $this->hasOne(LoyaltyTransaction::class);
    }

    /**
     * Scope a query to only include upcoming bookings.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date_time', '>', now())
                    ->where('status', 'booked');
    }

    /**
     * Scope a query to only include past bookings.
     */
    public function scopePast($query)
    {
        return $query->where('date_time', '<', now());
    }

    /**
     * Scope a query to only include cancelled bookings.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Check if booking is upcoming.
     */
    public function getIsUpcomingAttribute()
    {
        return $this->date_time > now() && $this->status === 'booked';
    }

    /**
     * Check if booking is past.
     */
    public function getIsPastAttribute()
    {
        return $this->date_time < now();
    }

    /**
     * Check if booking is cancelled.
     */
    public function getIsCancelledAttribute()
    {
        return $this->status === 'cancelled';
    }

    /**
     * Check if booking is completed.
     */
    public function getIsCompletedAttribute()
    {
        return $this->status === 'completed';
    }
}