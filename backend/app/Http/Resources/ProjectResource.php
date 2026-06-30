<?php

namespace App\Http\Resources;

use App\Support\MediaUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', $request->query('locale', 'ar'));
        $isAdmin = $request->boolean('_admin') || $request->routeIs('admin.*');

        $base = [
            'id'          => $this->id,
            'slug'        => $this->slug,
            'category'    => new ProjectCategoryResource($this->whenLoaded('category')),
            'area'        => $this->area,
            'year'        => $this->year,
            'featured'    => $this->featured,
            'status'      => $this->status,
            'sort_order'  => $this->sort_order,
            'cover'       => MediaUrl::resolve($this->cover_image),
            'images'      => $this->gallery_images
                ? collect($this->gallery_images)->map(fn($p) => MediaUrl::resolve($p))->toArray()
                : [],
            'before_image' => MediaUrl::resolve($this->before_image),
            'after_image'  => MediaUrl::resolve($this->after_image),
            'video_url'    => $this->video_url,
            'created_at'   => $this->created_at?->toISOString(),
        ];

        if ($isAdmin) {
            return array_merge($base, [
                'title_ar'              => $this->title_ar,
                'title_en'              => $this->title_en,
                'description_ar'        => $this->description_ar,
                'description_en'        => $this->description_en,
                'location_ar'           => $this->location_ar,
                'location_en'           => $this->location_en,
                'services_ar'           => $this->services_ar ?? [],
                'services_en'           => $this->services_en ?? [],
                'meta_title_ar'         => $this->meta_title_ar,
                'meta_title_en'         => $this->meta_title_en,
                'meta_description_ar'   => $this->meta_description_ar,
                'meta_description_en'   => $this->meta_description_en,
            ]);
        }

        return array_merge($base, [
            'title'       => str_starts_with($locale, 'en') ? $this->title_en : $this->title_ar,
            'description' => str_starts_with($locale, 'en') ? $this->description_en : $this->description_ar,
            'location'    => str_starts_with($locale, 'en') ? $this->location_en : $this->location_ar,
            'services'    => (str_starts_with($locale, 'en') ? $this->services_en : $this->services_ar) ?? [],
            'title_ar'    => $this->title_ar,
            'title_en'    => $this->title_en,
            'location_ar' => $this->location_ar,
            'location_en' => $this->location_en,
            'services_ar' => $this->services_ar ?? [],
            'services_en' => $this->services_en ?? [],
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
        ]);
    }
}
