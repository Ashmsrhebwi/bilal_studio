<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationRequest;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    public function messages(Request $request): JsonResponse
    {
        $messages = ContactMessage::when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderByDesc('created_at')
            ->paginate($request->integer('per_page', 20));

        return response()->json([
            'success' => true,
            'data'    => $messages->items(),
            'meta'    => ['total' => $messages->total(), 'last_page' => $messages->lastPage()],
        ]);
    }

    public function showMessage(ContactMessage $contactMessage): JsonResponse
    {
        $contactMessage->update(['status' => 'read']);
        return response()->json(['success' => true, 'data' => $contactMessage]);
    }

    public function updateMessageStatus(Request $request, ContactMessage $contactMessage): JsonResponse
    {
        $request->validate(['status' => 'required|in:new,read,replied,archived', 'admin_notes' => 'nullable|string']);
        $contactMessage->update($request->only('status', 'admin_notes'));

        return response()->json(['success' => true, 'data' => $contactMessage->fresh()]);
    }

    public function deleteMessage(ContactMessage $contactMessage): JsonResponse
    {
        $contactMessage->delete();
        return response()->json(['success' => true]);
    }

    // Consultation requests
    public function consultations(Request $request): JsonResponse
    {
        $items = ConsultationRequest::when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderByDesc('created_at')
            ->paginate($request->integer('per_page', 20));

        return response()->json([
            'success' => true,
            'data'    => $items->items(),
            'meta'    => ['total' => $items->total()],
        ]);
    }

    public function updateConsultationStatus(Request $request, ConsultationRequest $consultationRequest): JsonResponse
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled,completed', 'admin_notes' => 'nullable|string']);
        $consultationRequest->update($request->only('status', 'admin_notes'));

        return response()->json(['success' => true, 'data' => $consultationRequest->fresh()]);
    }
}
