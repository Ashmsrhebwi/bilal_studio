<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogPublicController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $posts = BlogPost::with('category')
            ->published()
            ->when($request->category, fn($q) => $q->whereHas('category', fn($q2) => $q2->where('slug', $request->category)))
            ->when($request->featured, fn($q) => $q->where('featured', true))
            ->orderByDesc('published_at')
            ->paginate($request->integer('per_page', 9));

        return response()->json([
            'success' => true,
            'data'    => BlogPostResource::collection($posts->items()),
            'meta'    => [
                'total'        => $posts->total(),
                'per_page'     => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page'    => $posts->lastPage(),
            ],
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $post = BlogPost::with('category')
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $post->increment('views');

        return response()->json(['success' => true, 'data' => new BlogPostResource($post)]);
    }

    public function categories(): JsonResponse
    {
        $categories = BlogCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json(['success' => true, 'data' => $categories]);
    }

    public function featured(): JsonResponse
    {
        $posts = BlogPost::with('category')
            ->published()
            ->where('featured', true)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return response()->json(['success' => true, 'data' => BlogPostResource::collection($posts)]);
    }
}
