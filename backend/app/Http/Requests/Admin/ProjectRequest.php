<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('project');

        return [
            'category_id'           => ['required', 'exists:project_categories,id'],
            'title_ar'              => ['required', 'string', 'max:255'],
            'title_en'              => ['required', 'string', 'max:255'],
            'slug'                  => ['nullable', 'string', 'unique:projects,slug,' . ($id ? $id->id : 'NULL')],
            'description_ar'        => ['nullable', 'string'],
            'description_en'        => ['nullable', 'string'],
            'location_ar'           => ['nullable', 'string', 'max:255'],
            'location_en'           => ['nullable', 'string', 'max:255'],
            'area'                  => ['nullable', 'numeric', 'min:1'],
            'year'                  => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 5)],
            'services_ar'           => ['nullable', 'array'],
            'services_en'           => ['nullable', 'array'],
            'cover_image'           => ['nullable', 'image', 'max:5120'],
            'gallery_images'        => ['nullable', 'array'],
            'gallery_images.*'      => ['image', 'max:5120'],
            'before_image'          => ['nullable', 'image', 'max:5120'],
            'after_image'           => ['nullable', 'image', 'max:5120'],
            'video_url'             => ['nullable', 'url'],
            'featured'              => ['boolean'],
            'status'                => ['required', 'in:published,draft'],
            'sort_order'            => ['integer'],
            'meta_title_ar'         => ['nullable', 'string', 'max:255'],
            'meta_title_en'         => ['nullable', 'string', 'max:255'],
            'meta_description_ar'   => ['nullable', 'string', 'max:500'],
            'meta_description_en'   => ['nullable', 'string', 'max:500'],
        ];
    }
}
