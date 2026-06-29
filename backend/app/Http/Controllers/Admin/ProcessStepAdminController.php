<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProcessStep;

class ProcessStepAdminController extends GenericCrudController
{
    protected string $modelClass = ProcessStep::class;
    protected array $imageFields = [];

    protected array $rules = [
        'title_ar'       => 'required|string|max:255',
        'title_en'       => 'required|string|max:255',
        'description_ar' => 'nullable|string',
        'description_en' => 'nullable|string',
        'icon'           => 'nullable|string|max:100',
        'step_number'    => 'required|integer|min:1',
        'is_active'      => 'boolean',
    ];
}
