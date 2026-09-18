<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomTransfer extends Model
{
    protected $guarded = ['id'];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function fromAllocation()
    {
        return $this->belongsTo(Allocation::class, 'from_allocation_id');
    }

    public function toAllocation()
    {
        return $this->belongsTo(Allocation::class, 'to_allocation_id');
    }
}
