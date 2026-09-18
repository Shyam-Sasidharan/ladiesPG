<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id'];

    public function resident()
    {
        return $this->belongsTo(Resident::class)->withTrashed();
    }

    public function rentRecord()
    {
        return $this->belongsTo(RentRecord::class);
    }
}
