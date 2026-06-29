<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BlogPostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                   => $this->id,
            'slug'                 => $this->slug,
            'category_id'          => $this->category_id,
            'category'             => $this->whenLoaded('category', fn() => [
                'id'      => $this->category->id,
                'name_ar' => $this->category->name_ar,
                'name_en' => $this->category->name_en,
            ]),
            'title_ar'             => $this->title_ar,
            'title_en'             => $this->title_en,
            'excerpt_ar'           => $this->excerpt_ar,
            'excerpt_en'           => $this->excerpt_en,
            'content_ar'           => $this->content_ar,
            'content_en'           => $this->content_en,
            'image'                => $this->cover_image ? Storage::disk('public')->url($this->cover_image) : null,
            'author_ar'            => $this->author_ar,
            'author_en'            => $this->author_en,
            'read_time'            => $this->read_time,
            'featured'             => $this->featured,
            'status'               => $this->status,
            'date'                 => $this->published_at?->format('Y-m-d'),
            'meta_title_ar'        => $this->meta_title_ar,
            'meta_title_en'        => $this->meta_title_en,
            'meta_description_ar'  => $this->meta_description_ar,
            'meta_description_en'  => $this->meta_description_en,
            'views'                => $this->views,
        ];
    }
}
