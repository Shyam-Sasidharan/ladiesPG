<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RentRecord extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['month' => 'date', 'due_date' => 'date'];
    }

    public function setMonthAttribute($value): void
    {
        $this->attributes['month'] = Carbon::parse($value)->startOfMonth()->toDateString();
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class)->withTrashed();
    }

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getPendingAttribute()
    {
        return max(0, round($this->amount + $this->late_fee - $this->payments->sum('amount'), 2));
    }

    public function getStatusAttribute()
    {
        return $this->pending <= 0 ? 'paid' : ($this->payments->sum('amount') > 0 ? 'partially_paid' : ($this->due_date->isBefore(today()) ? 'overdue' : 'pending'));
    }
}
