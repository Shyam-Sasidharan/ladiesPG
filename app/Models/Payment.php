<?php

namespace App\Models;

use App\Services\AccountingService;
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

    public function financialTransaction()
    {
        return $this->morphOne(FinancialTransaction::class, 'source');
    }

    protected static function booted(): void
    {
        static::created(fn (Payment $payment) => app(AccountingService::class)->recordPayment($payment));
    }
}
