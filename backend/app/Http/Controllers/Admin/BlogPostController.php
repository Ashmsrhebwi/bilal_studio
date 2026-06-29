<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogPostRequest;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Services\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function __construct(private readonly MediaService $mediaService) {}

    public function index(Request $request): JsonResponse
    {
        $posts = BlogPost::with('category')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->search, fn($q) => $q->where(fn($q2) =>
                $q2->where('title_ar', 'like', "%{$request->search}%")
                   ->orWhere('title_en', 'like', "%{$request->search}%")
            ))
            ->orderByDesc('created_at')
            ->paginate($request->integer('per_page', 15));

        return response()->json([
            'success' => true,
            'data'    => BlogPostResource::collection($posts->items()),
            'meta'    => ['total' => $posts->total(), 'last_page' => $posts->lastPage(), 'current_page' => $posts->currentPage()],
        ]);
    }

    public function store(BlogPostRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['title_en'] ?: $data['title_ar']);

        if ($request->hasFile('cover_image')) {
            $media = $this->mediaService->upload($request->file('cover_image'), 'blog');
            $data['cover_image'] = $media->file_path;
        }

        $post = BlogPost::create($data);

        return response()->json(['success' => true, 'data' => new BlogPostResource($post->load('category'))], 201);
    }

    public function show(BlogPost $blogPost): JsonResponse
    {
        return response()->json(['success' => true, 'data' => new BlogPostResource($blogPost->load('category'))]);
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            if ($blogPost->cover_image) Storage::disk('public')->delete($blogPost->cover_image);
            $media = $this->mediaService->upload($request->file('cover_image'), 'blog');
            $data['cover_image'] = $media->file_path;
        }

        $blogPost->update($data);

        return response()->json(['success' => true, 'data' => new BlogPostResource($blogPost->fresh()->load('category'))]);
    }

    public function destroy(BlogPost $blogPost): JsonResponse
    {
        $blogPost->delete();
        return response()->json(['success' => true, 'message' => 'تم حذف المقال.']);
    }

    // Blog Categories
    public function categories(): JsonResponse
    {
        return response()->json(['success' => true, 'data' => BlogCategory::all()]);
    }

    public function storeCategory(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:100',
            'name_en' => 'required|string|max:100',
            'slug'    => 'nullable|string|unique:blog_categories,slug',
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name_en']);
        $cat = BlogCategory::create($data);
        return response()->json(['success' => true, 'data' => $cat], 201);
    }
}
