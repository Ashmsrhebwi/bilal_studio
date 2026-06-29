<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'title_ar', 'title_en', 'slug',
        'excerpt_ar', 'excerpt_en',
        'content_ar', 'content_en',
        'cover_image', 'author_ar', 'author_en',
        'read_time', 'status', 'published_at', 'featured',
        'meta_title_ar', 'meta_title_en',
        'meta_description_ar', 'meta_description_en',
        'views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured'     => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
