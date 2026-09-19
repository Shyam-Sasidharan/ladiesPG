<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $guarded = ['id'];

    public function transactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }
}
