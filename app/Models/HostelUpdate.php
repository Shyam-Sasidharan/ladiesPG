<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostelUpdate extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'views_count' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
