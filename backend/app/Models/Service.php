<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'slug',
        'description_ar', 'description_en',
        'details_ar', 'details_en',
        'icon', 'image', 'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];
}
