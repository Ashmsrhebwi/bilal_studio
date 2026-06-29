<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'title_ar', 'title_en', 'slug',
        'description_ar', 'description_en',
        'location_ar', 'location_en',
        'area', 'year',
        'services_ar', 'services_en',
        'cover_image', 'gallery_images',
        'before_image', 'after_image', 'video_url',
        'featured', 'status', 'sort_order',
        'meta_title_ar', 'meta_title_en',
        'meta_description_ar', 'meta_description_en',
    ];

    protected $casts = [
        'services_ar'    => 'array',
        'services_en'    => 'array',
        'gallery_images' => 'array',
        'featured'       => 'boolean',
        'area'           => 'float',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = \Str::slug($project->title_en ?: $project->title_ar);
            }
        });
    }
}
