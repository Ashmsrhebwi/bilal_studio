<?php

namespace App\Http\Resources;

use App\Support\MediaUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'name_ar'        => $this->name_ar,
            'name_en'        => $this->name_en,
            'slug'           => $this->slug,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'details_ar'     => $this->details_ar,
            'details_en'     => $this->details_en,
            'icon'           => $this->icon,
            'image'          => MediaUrl::resolve($this->image),
            'sort_order'     => $this->sort_order,
            'is_active'      => $this->is_active,
        ];
    }
}
