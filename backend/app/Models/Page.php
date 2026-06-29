<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug', 'title_ar', 'title_en',
        'content_ar', 'content_en',
        'meta_title_ar', 'meta_title_en',
        'meta_description_ar', 'meta_description_en',
        'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];
}
