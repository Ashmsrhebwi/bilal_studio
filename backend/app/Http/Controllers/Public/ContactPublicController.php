<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\ContactRequest;
use App\Http\Requests\Public\ConsultationRequest as ConsultationFormRequest;
use App\Models\ContactMessage;
use App\Models\ConsultationRequest;
use App\Notifications\ContactMessageNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class ContactPublicController extends Controller
{
    public function sendMessage(ContactRequest $request): JsonResponse
    {
        $message = ContactMessage::create($request->validated());

        try {
            Notification::route('mail', config('app.admin_email', env('ADMIN_EMAIL')))
                ->notify(new ContactMessageNotification($message));
        } catch (\Throwable) {
            // Silently fail — message is saved regardless
        }

        return response()->json([
            'success' => true,
            'message' => 'تم استلام رسالتك، سنتواصل معك قريباً.',
        ], 201);
    }

    public function bookConsultation(ConsultationFormRequest $request): JsonResponse
    {
        ConsultationRequest::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل طلب الاستشارة بنجاح، سنتواصل معك لتأكيد الموعد.',
        ], 201);
    }
}
