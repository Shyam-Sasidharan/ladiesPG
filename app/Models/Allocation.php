<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $guarded = ['id'];

    public function resident()
    {
        return $this->belongsTo(Resident::class)->withTrashed();
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }
}
