<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'location',
        'max_guests',
        'image',
        'is_available',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'is_available'    => 'boolean',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailableFor(string $startDate, string $endDate): bool
    {
        return ! $this->bookings()
            ->whereIn('status', ['pending', 'confirmed'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<=', $startDate)
                          ->where('end_date', '>=', $endDate);
                    });
            })
            ->exists();
    }

    public function calculateTotal(string $startDate, string $endDate): float
    {
        $nights = (int) now()->parse($startDate)->diffInDays($endDate);
        return $nights * $this->price_per_night;
    }
}