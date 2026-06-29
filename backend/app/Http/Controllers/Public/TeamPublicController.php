<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ProcessStep;
use App\Models\TeamMember;
use App\Models\TimelineEvent;
use Illuminate\Http\JsonResponse;

class TeamPublicController extends Controller
{
    public function team(): JsonResponse
    {
        $members = TeamMember::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json(['success' => true, 'data' => $members]);
    }

    public function timeline(): JsonResponse
    {
        $events = TimelineEvent::orderBy('year')->get();

        return response()->json(['success' => true, 'data' => $events]);
    }

    public function processSteps(): JsonResponse
    {
        $steps = ProcessStep::where('is_active', true)
            ->orderBy('step_number')
            ->get();

        return response()->json(['success' => true, 'data' => $steps]);
    }
}
