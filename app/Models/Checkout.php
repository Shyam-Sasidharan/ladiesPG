<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['date' => 'date', 'notice_date' => 'date'];
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class)->withTrashed();
    }

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }
}
