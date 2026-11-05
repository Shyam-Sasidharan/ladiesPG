<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomCapacityHistory extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'effective_from' => 'date',
            'effective_to' => 'date',
            'monthly_rent' => 'decimal:2',
            'rent_without_food' => 'decimal:2',
        ];
    }

    public function room()
    {
        return $this->belongsTo(Room::class)->withTrashed();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
