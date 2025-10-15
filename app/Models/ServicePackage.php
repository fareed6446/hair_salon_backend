<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'name',
        'price',
        'duration_minutes',
        'details',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_minutes' => 'integer',
    ];

    /**
     * Get the service that owns the package.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the bookings for the package.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}