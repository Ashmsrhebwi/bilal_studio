<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceAdminController extends GenericCrudController
{
    protected string $modelClass = Service::class;
    protected array $imageFields = ['image'];
    protected string $imageFolder = 'services';

    protected array $rules = [
        'name_ar'        => 'required|string|max:255',
        'name_en'        => 'required|string|max:255',
        'slug'           => 'nullable|string',
        'description_ar' => 'nullable|string',
        'description_en' => 'nullable|string',
        'details_ar'     => 'nullable|string',
        'details_en'     => 'nullable|string',
        'icon'           => 'nullable|string|max:100',
        'image'          => 'nullable|image|max:5120',
        'sort_order'     => 'integer',
        'is_active'      => 'boolean',
    ];
}
