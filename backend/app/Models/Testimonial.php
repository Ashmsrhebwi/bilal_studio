<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'role_ar', 'role_en',
        'project_ar', 'project_en',
        'text_ar', 'text_en',
        'rating', 'avatar',
        'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean', 'rating' => 'integer'];
}
