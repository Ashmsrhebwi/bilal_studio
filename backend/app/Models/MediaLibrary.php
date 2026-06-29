<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class MediaLibrary extends Model
{
    protected $fillable = [
        'file_name', 'file_path', 'file_type', 'mime_type',
        'file_size', 'thumbnail_path', 'width', 'height',
        'alt_text_ar', 'alt_text_en', 'disk',
        'mediable_type', 'mediable_id',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->file_path);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail_path
            ? Storage::disk($this->disk)->url($this->thumbnail_path)
            : null;
    }

    protected $appends = ['url', 'thumbnail_url'];
}
