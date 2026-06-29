<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineEvent extends Model
{
    protected $fillable = [
        'year', 'title_ar', 'title_en',
        'description_ar', 'description_en',
        'icon', 'sort_order',
    ];
}
