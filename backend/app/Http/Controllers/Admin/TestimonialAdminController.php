<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;

class TestimonialAdminController extends GenericCrudController
{
    protected string $modelClass = Testimonial::class;
    protected array $imageFields = ['avatar'];
    protected string $imageFolder = 'testimonials';

    protected array $rules = [
        'name_ar'    => 'required|string|max:100',
        'name_en'    => 'required|string|max:100',
        'role_ar'    => 'nullable|string|max:100',
        'role_en'    => 'nullable|string|max:100',
        'project_ar' => 'nullable|string|max:255',
        'project_en' => 'nullable|string|max:255',
        'text_ar'    => 'required|string',
        'text_en'    => 'required|string',
        'rating'     => 'integer|min:1|max:5',
        'avatar'     => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:2048',
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];
}
