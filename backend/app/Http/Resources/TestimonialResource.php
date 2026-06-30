<?php

namespace App\Http\Resources;

use App\Support\MediaUrl;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name_ar'    => $this->name_ar,
            'name_en'    => $this->name_en,
            'role_ar'    => $this->role_ar,
            'role_en'    => $this->role_en,
            'project_ar' => $this->project_ar,
            'project_en' => $this->project_en,
            'text_ar'    => $this->text_ar,
            'text_en'    => $this->text_en,
            'rating'     => $this->rating,
            'avatar'     => MediaUrl::resolve($this->avatar),
            'is_active'  => $this->is_active,
            'sort_order' => $this->sort_order,
        ];
    }
}
