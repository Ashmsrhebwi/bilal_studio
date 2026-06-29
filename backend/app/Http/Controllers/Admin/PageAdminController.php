<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageAdminController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['success' => true, 'data' => Page::all()]);
    }

    public function show(string $slug): JsonResponse
    {
        return response()->json(['success' => true, 'data' => Page::where('slug', $slug)->firstOrFail()]);
    }

    public function update(Request $request, string $slug): JsonResponse
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $data = $request->validate([
            'title_ar'              => 'string|max:255',
            'title_en'              => 'string|max:255',
            'content_ar'            => 'nullable|string',
            'content_en'            => 'nullable|string',
            'meta_title_ar'         => 'nullable|string|max:255',
            'meta_title_en'         => 'nullable|string|max:255',
            'meta_description_ar'   => 'nullable|string|max:500',
            'meta_description_en'   => 'nullable|string|max:500',
            'is_active'             => 'boolean',
        ]);
        $page->update($data);

        return response()->json(['success' => true, 'data' => $page->fresh()]);
    }
}
