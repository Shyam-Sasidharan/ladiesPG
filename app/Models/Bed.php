<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $guarded = ['id'];

    public function room()
    {
        return $this->belongsTo(Room::class)->withTrashed();
    }

    public function activeAllocation()
    {
        return $this->hasOne(ActiveAllocation::class);
    }

    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

    public function getEffectiveStatusAttribute()
    {
        if ($this->activeAllocation) {
            return 'occupied';
        }

        if ($this->status === 'archived') {
            return 'archived';
        }

        return ($this->room->status !== 'active' || $this->room->trashed()) ? 'maintenance' : $this->status;
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->tier ? "{$this->name} ({$this->tier})" : $this->name;
    }
}
