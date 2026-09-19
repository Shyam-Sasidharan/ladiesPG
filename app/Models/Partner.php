<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['profit_share' => 'decimal:2'];
    }

    public function transactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }
}
