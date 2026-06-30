<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;

class PartnerAdminController extends GenericCrudController
{
    protected string $modelClass = Partner::class;
    protected array $imageFields = ['logo'];
    protected string $imageFolder = 'partners';

    protected array $rules = [
        'name'        => 'required|string|max:100',
        'logo'        => 'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:2048',
        'website_url' => 'nullable|url',
        'sort_order'  => 'integer',
        'is_active'   => 'boolean',
    ];
}
