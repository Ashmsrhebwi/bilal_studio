<?php

namespace App\Http\Controllers\Admin;

use App\Models\TeamMember;
use App\Models\TimelineEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamMemberAdminController extends GenericCrudController
{
    protected string $modelClass = TeamMember::class;
    protected array $imageFields = ['photo'];
    protected string $imageFolder = 'team';

    protected array $rules = [
        'name_ar'        => 'required|string|max:100',
        'name_en'        => 'required|string|max:100',
        'role_ar'        => 'nullable|string|max:100',
        'role_en'        => 'nullable|string|max:100',
        'bio_ar'         => 'nullable|string',
        'bio_en'         => 'nullable|string',
        'photo'          => 'nullable|image|max:5120',
        'certifications' => 'nullable|array',
        'linkedin_url'   => 'nullable|url',
        'is_founder'     => 'boolean',
        'sort_order'     => 'integer',
        'is_active'      => 'boolean',
    ];

    // Timeline events
    public function timelineIndex(): JsonResponse
    {
        return response()->json(['success' => true, 'data' => TimelineEvent::orderBy('year')->get()]);
    }

    public function timelineStore(Request $request): JsonResponse
    {
        $data = $request->validate([
            'year'           => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'title_ar'       => 'required|string|max:255',
            'title_en'       => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon'           => 'nullable|string',
            'sort_order'     => 'integer',
        ]);
        $event = TimelineEvent::create($data);
        return response()->json(['success' => true, 'data' => $event], 201);
    }

    public function timelineUpdate(Request $request, int $id): JsonResponse
    {
        $event = TimelineEvent::findOrFail($id);
        $data = $request->validate([
            'year'           => 'integer|min:1900',
            'title_ar'       => 'string|max:255',
            'title_en'       => 'string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon'           => 'nullable|string',
            'sort_order'     => 'integer',
        ]);
        $event->update($data);
        return response()->json(['success' => true, 'data' => $event->fresh()]);
    }

    public function timelineDestroy(int $id): JsonResponse
    {
        TimelineEvent::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
