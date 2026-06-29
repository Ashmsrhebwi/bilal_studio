<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;

class SiteSettingsPublicController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = SiteSetting::all()->groupBy('group');
        $result = [];

        foreach ($settings as $group => $items) {
            foreach ($items as $item) {
                $result[$group][$item->key] = $item->type === 'json'
                    ? json_decode($item->value, true)
                    : $item->value;
            }
        }

        return response()->json(['success' => true, 'data' => $result]);
    }

    public function getGroup(string $group): JsonResponse
    {
        $settings = SiteSetting::where('group', $group)
            ->get()
            ->pluck('value', 'key');

        return response()->json(['success' => true, 'data' => $settings]);
    }
}
