<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'min:2', 'max:100'],
            'email'        => ['required', 'email', 'max:255'],
            'phone'        => ['nullable', 'string', 'regex:/^[+\d\s\-\(\)]{8,20}$/'],
            'project_type' => ['nullable', 'string', 'in:residential,commercial,interior,exterior,hospitality,other'],
            'message'      => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'الاسم مطلوب.',
            'email.required'   => 'البريد الإلكتروني مطلوب.',
            'email.email'      => 'البريد الإلكتروني غير صحيح.',
            'message.required' => 'الرسالة مطلوبة.',
            'message.min'      => 'الرسالة يجب أن تكون 10 أحرف على الأقل.',
        ];
    }
}
