<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;

class FaqAdminController extends GenericCrudController
{
    protected string $modelClass = Faq::class;
    protected array $imageFields = [];
    protected string $imageFolder = '';

    protected array $rules = [
        'question_ar' => 'required|string',
        'question_en' => 'required|string',
        'answer_ar'   => 'required|string',
        'answer_en'   => 'required|string',
        'sort_order'  => 'integer',
        'is_active'   => 'boolean',
    ];
}
