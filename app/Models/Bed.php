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
        return $this->activeAllocation ? 'occupied' : ($this->room->status !== 'active' || $this->room->trashed() ? 'maintenance' : $this->status);
    }
}
