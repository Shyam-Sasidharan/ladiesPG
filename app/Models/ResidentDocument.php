<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResidentDocument extends Model
{
    protected $guarded = ['id'];

    use SoftDeletes;

    public function resident()
    {
        return $this->belongsTo(Resident::class)->withTrashed();
    }
}
