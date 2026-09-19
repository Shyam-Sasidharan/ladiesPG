<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['transaction_date' => 'date', 'amount' => 'decimal:2'];
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class)->withTrashed();
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class)->withTrashed();
    }

    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function source()
    {
        return $this->morphTo();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function reversalOf()
    {
        return $this->belongsTo(self::class, 'reversal_of_id');
    }

    public function reversal()
    {
        return $this->hasOne(self::class, 'reversal_of_id');
    }
}
