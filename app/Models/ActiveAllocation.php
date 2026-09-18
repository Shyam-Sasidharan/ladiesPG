<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveAllocation extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }
}
