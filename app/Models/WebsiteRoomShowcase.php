<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteRoomShowcase extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'monthly_rent' => 'decimal:2',
        'rent_without_food' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
