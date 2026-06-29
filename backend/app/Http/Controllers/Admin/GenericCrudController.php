<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MediaService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Reusable CRUD controller for simple models (Testimonials, Services, Partners, FAQs, ProcessSteps, TeamMembers, etc.)
 */
class GenericCrudController extends Controller
{
    protected string $modelClass;
    protected array $rules = [];
    protected array $imageFields = [];
    protected string $imageFolder = 'media';
    protected string $resourceKey = 'data';

    public function __construct(private readonly MediaService $mediaService) {}

    public function index(Request $request): JsonResponse
    {
        $query = $this->modelClass::query();

        if ($request->filled('search') && method_exists($this->modelClass, 'scopeSearch')) {
            $query->search($request->search);
        }

        $items = $query->orderBy('sort_order')->get();

        return response()->json(['success' => true, 'data' => $items]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate($this->rules);
        $data = $this->handleImages($request, $data);

        $item = $this->modelClass::create($data);

        return response()->json(['success' => true, 'data' => $item], 201);
    }

    public function show(int $id): JsonResponse
    {
        $item = $this->modelClass::findOrFail($id);
        return response()->json(['success' => true, 'data' => $item]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = $this->modelClass::findOrFail($id);
        $data = $request->validate($this->rules);
        $data = $this->handleImages($request, $data, $item);

        $item->update($data);

        return response()->json(['success' => true, 'data' => $item->fresh()]);
    }

    public function destroy(int $id): JsonResponse
    {
        $item = $this->modelClass::findOrFail($id);

        foreach ($this->imageFields as $field) {
            if ($item->$field) Storage::disk('public')->delete($item->$field);
        }

        $item->delete();

        return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح.']);
    }

    private function handleImages(Request $request, array $data, ?Model $existing = null): array
    {
        foreach ($this->imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($existing?->$field) {
                    Storage::disk('public')->delete($existing->$field);
                }
                $media = $this->mediaService->upload($request->file($field), $this->imageFolder);
                $data[$field] = $media->file_path;
            }
        }
        return $data;
    }
}
