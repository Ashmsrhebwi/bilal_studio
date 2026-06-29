<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessStep extends Model
{
    protected $fillable = [
        'title_ar', 'title_en',
        'description_ar', 'description_en',
        'icon', 'step_number', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];
}
