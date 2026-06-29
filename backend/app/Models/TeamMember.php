<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'role_ar', 'role_en',
        'bio_ar', 'bio_en', 'photo',
        'certifications', 'linkedin_url',
        'is_founder', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'certifications' => 'array',
        'is_founder'     => 'boolean',
        'is_active'      => 'boolean',
    ];
}
