<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question_ar', 'question_en',
        'answer_ar', 'answer_en',
        'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];
}
