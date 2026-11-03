<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    protected $guarded = ['id'];

    use SoftDeletes;

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function beds()
    {
        return $this->hasMany(Bed::class)->orderBy('position');
    }

    public function getOccupiedAttribute()
    {
        return $this->beds->filter(fn ($b) => $b->effective_status === 'occupied')->count();
    }

    public function getAvailableAttribute()
    {
        return $this->beds->filter(fn ($b) => $b->effective_status === 'available')->count();
    }

    public function getRentWithFoodAttribute(): float
    {
        return (float) $this->monthly_rent;
    }

    public function getRentWithoutFoodDisplayAttribute(): float
    {
        return (float) ($this->rent_without_food ?? $this->monthly_rent);
    }

    public function getAvailabilityStatusAttribute(): string
    {
        if ($this->status !== 'active' || $this->trashed()) {
            return 'Maintenance';
        }
        if ($this->available === 0) {
            return 'Fully Booked';
        }
        if ($this->occupied > 0) {
            return 'Available';
        }

        return 'Available';
    }

    public function getSharingLabelAttribute(): string
    {
        return match ($this->capacity) {
            2 => 'Two Sharing',
            3 => 'Three Sharing',
            4 => 'Four Sharing',
            5 => 'Five Sharing',
            6 => 'Six Sharing',
            default => $this->type ?? ($this->capacity.' Sharing'),
        };
    }
}
