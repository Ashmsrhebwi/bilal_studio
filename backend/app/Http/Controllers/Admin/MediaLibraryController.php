<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaLibrary;
use App\Services\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaLibraryController extends Controller
{
    public function __construct(private readonly MediaService $mediaService) {}

    public function index(Request $request): JsonResponse
    {
        $media = MediaLibrary::when($request->type, fn($q) => $q->where('file_type', $request->type))
            ->orderByDesc('created_at')
            ->paginate($request->integer('per_page', 24));

        return response()->json([
            'success' => true,
            'data'    => $media->items(),
            'meta'    => ['total' => $media->total(), 'last_page' => $media->lastPage()],
        ]);
    }

    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file'        => 'required|file|max:20480|mimes:jpg,jpeg,png,webp,gif,mp4,mov,avi,pdf',
            'alt_text_ar' => 'nullable|string|max:255',
            'alt_text_en' => 'nullable|string|max:255',
            'folder'      => 'nullable|string|max:100',
        ]);

        $media = $this->mediaService->upload(
            $request->file('file'),
            $request->input('folder', 'library'),
            $request->alt_text_ar,
            $request->alt_text_en
        );

        return response()->json(['success' => true, 'data' => $media], 201);
    }

    public function destroy(MediaLibrary $mediaLibrary): JsonResponse
    {
        $this->mediaService->delete($mediaLibrary);
        return response()->json(['success' => true, 'message' => 'تم حذف الملف.']);
    }

    public function update(Request $request, MediaLibrary $mediaLibrary): JsonResponse
    {
        $request->validate([
            'alt_text_ar' => 'nullable|string|max:255',
            'alt_text_en' => 'nullable|string|max:255',
        ]);
        $mediaLibrary->update($request->only('alt_text_ar', 'alt_text_en'));

        return response()->json(['success' => true, 'data' => $mediaLibrary->fresh()]);
    }
}
