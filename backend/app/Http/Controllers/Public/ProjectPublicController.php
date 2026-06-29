<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectPublicController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $projects = Project::with('category')
            ->published()
            ->when($request->category, fn($q) => $q->whereHas('category', fn($q2) => $q2->where('slug', $request->category)))
            ->when($request->featured, fn($q) => $q->featured())
            ->orderBy('sort_order')
            ->orderByDesc('year')
            ->paginate($request->integer('per_page', 12));

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

    public function show(string $slug): JsonResponse
    {
        $project = Project::with('category')
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json(['success' => true, 'data' => new ProjectResource($project)]);
    }

    public function featured(): JsonResponse
    {
        $projects = Project::with('category')
            ->published()
            ->featured()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return response()->json(['success' => true, 'data' => ProjectResource::collection($projects)]);
    }

    public function categories(): JsonResponse
    {
        $categories = ProjectCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json(['success' => true, 'data' => $categories]);
    }
}
