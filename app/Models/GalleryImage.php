<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_tall' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
