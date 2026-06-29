<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('blog_post');

        return [
            'category_id'           => ['nullable', 'exists:blog_categories,id'],
            'title_ar'              => ['required', 'string', 'max:255'],
            'title_en'              => ['required', 'string', 'max:255'],
            'slug'                  => ['nullable', 'string', 'unique:blog_posts,slug,' . ($id ? $id->id : 'NULL')],
            'excerpt_ar'            => ['nullable', 'string'],
            'excerpt_en'            => ['nullable', 'string'],
            'content_ar'            => ['nullable', 'string'],
            'content_en'            => ['nullable', 'string'],
            'cover_image'           => ['nullable', 'image', 'max:5120'],
            'author_ar'             => ['nullable', 'string', 'max:100'],
            'author_en'             => ['nullable', 'string', 'max:100'],
            'read_time'             => ['integer', 'min:1', 'max:120'],
            'status'                => ['required', 'in:published,draft'],
            'published_at'          => ['nullable', 'date'],
            'featured'              => ['boolean'],
            'meta_title_ar'         => ['nullable', 'string', 'max:255'],
            'meta_title_en'         => ['nullable', 'string', 'max:255'],
            'meta_description_ar'   => ['nullable', 'string', 'max:500'],
            'meta_description_en'   => ['nullable', 'string', 'max:500'],
        ];
    }
}
