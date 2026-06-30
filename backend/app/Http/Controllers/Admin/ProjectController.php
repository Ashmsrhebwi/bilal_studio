<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function __construct(private readonly MediaService $mediaService) {}

    public function index(Request $request): JsonResponse
    {
        $projects = Project::with('category')
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->search, fn($q) => $q->where(fn($q2) =>
                $q2->where('title_ar', 'like', "%{$request->search}%")
                   ->orWhere('title_en', 'like', "%{$request->search}%")
            ))
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate($request->integer('per_page', 15));

        return response()->json([
            'success' => true,
            'data'    => ProjectResource::collection($projects->items()),
            'meta'    => [
                'total'        => $projects->total(),
                'per_page'     => $projects->perPage(),
                'current_page' => $projects->currentPage(),
                'last_page'    => $projects->lastPage(),
            ],
        ]);
    }

    public function store(ProjectRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['title_en'] ?: $data['title_ar']);

        // Handle cover image
        if ($request->hasFile('cover_image')) {
            $media = $this->mediaService->upload($request->file('cover_image'), 'projects');
            $data['cover_image'] = $media->file_path;
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $paths = [];
            foreach ($request->file('gallery_images') as $img) {
                $media = $this->mediaService->upload($img, 'projects/gallery');
                $paths[] = $media->file_path;
            }
            $data['gallery_images'] = $paths;
        }

        // Handle before/after images
        foreach (['before_image', 'after_image'] as $field) {
            if ($request->hasFile($field)) {
                $media = $this->mediaService->upload($request->file($field), 'projects/before-after');
                $data[$field] = $media->file_path;
            }
        }

        $project = Project::create($data);

        return response()->json([
            'success' => true,
            'message' => 'تم إنشاء المشروع بنجاح.',
            'data'    => new ProjectResource($project->load('category')),
        ], 201);
    }

    public function show(Project $project): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => new ProjectResource($project->load('category')),
        ]);
    }

    public function update(ProjectRequest $request, Project $project): JsonResponse
    {
        $data = $request->validated();

        // Handle cover image replacement
        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $media = $this->mediaService->upload($request->file('cover_image'), 'projects');
            $data['cover_image'] = $media->file_path;
        }

        // Handle gallery images (append or replace)
        if ($request->hasFile('gallery_images')) {
            $paths = $project->gallery_images ?? [];
            foreach ($request->file('gallery_images') as $img) {
                $media = $this->mediaService->upload($img, 'projects/gallery');
                $paths[] = $media->file_path;
            }
            $data['gallery_images'] = $paths;
        }

        foreach (['before_image', 'after_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($project->$field) Storage::disk('public')->delete($project->$field);
                $media = $this->mediaService->upload($request->file($field), 'projects/before-after');
                $data[$field] = $media->file_path;
            }
        }

        $project->update($data);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث المشروع بنجاح.',
            'data'    => new ProjectResource($project->fresh()->load('category')),
        ]);
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return response()->json(['success' => true, 'message' => 'تم حذف المشروع.']);
    }

    public function removeGalleryImage(Project $project, Request $request): JsonResponse
    {
        $request->validate(['image_path' => 'required|string']);
        $path = $request->image_path;

        $gallery = collect($project->gallery_images ?? []);

        if (! $gallery->contains($path)) {
            return response()->json(['success' => false, 'message' => 'الصورة غير موجودة في معرض هذا المشروع.'], 404);
        }

        $images = $gallery->filter(fn($p) => $p !== $path)->values()->toArray();

        Storage::disk('public')->delete($path);
        $project->update(['gallery_images' => $images]);

        return response()->json(['success' => true, 'message' => 'تم حذف الصورة.']);
    }

    public function reorder(Request $request): JsonResponse
    {
        $request->validate(['items' => 'required|array', 'items.*.id' => 'required|integer', 'items.*.sort_order' => 'required|integer']);

        foreach ($request->items as $item) {
            Project::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => 'تم ترتيب المشاريع.']);
    }
}
