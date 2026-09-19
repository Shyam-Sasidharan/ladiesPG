<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resident extends Model
{
    protected $guarded = ['id'];

    use SoftDeletes;

    protected function casts(): array
    {
        return ['joining_date' => 'date', 'expected_checkout' => 'date', 'date_of_birth' => 'date'];
    }

    public function activeAllocation()
    {
        return $this->hasOne(ActiveAllocation::class);
    }

    public function allocations()
    {
        return $this->hasMany(Allocation::class)->latest();
    }

    public function documents()
    {
        return $this->hasMany(ResidentDocument::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->latest('payment_date');
    }

    public function rentRecords()
    {
        return $this->hasMany(RentRecord::class);
    }

    public function transfers()
    {
        return $this->hasMany(RoomTransfer::class);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class)->latest('date')->latest('id');
    }

    public function financialTransactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }
}
