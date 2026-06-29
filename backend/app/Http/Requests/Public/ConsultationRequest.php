<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'min:2', 'max:100'],
            'email'          => ['required', 'email', 'max:255'],
            'phone'          => ['required', 'string', 'regex:/^[+\d\s\-\(\)]{8,20}$/'],
            'project_type'   => ['nullable', 'string', 'in:residential,commercial,interior,exterior,hospitality,other'],
            'preferred_date' => ['nullable', 'date', 'after:today'],
            'preferred_time' => ['nullable', 'string', 'in:morning,afternoon,evening'],
            'notes'          => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'preferred_date.after' => 'يجب اختيار تاريخ مستقبلي.',
            'phone.required'       => 'رقم الهاتف مطلوب.',
        ];
    }
}
