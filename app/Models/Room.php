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
}
