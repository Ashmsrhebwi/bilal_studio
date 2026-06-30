<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SiteSettingController extends Controller
{
    public function __construct(private readonly MediaService $mediaService) {}

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

    public function updateBulk(Request $request): JsonResponse
    {
        $request->validate([
            'settings'       => 'required|array',
            'settings.*.key' => 'required|string',
        ]);

        foreach ($request->settings as $setting) {
            $value = is_array($setting['value']) ? json_encode($setting['value']) : $setting['value'];
            SiteSetting::setValue($setting['key'], $value);
        }

        // Clear all settings cache
        Cache::flush();

        return response()->json(['success' => true, 'message' => 'تم حفظ الإعدادات.']);
    }

    public function uploadLogo(Request $request): JsonResponse
    {
        $request->validate(['logo' => 'required|image|mimes:jpeg,jpg,png,webp,gif|max:2048']);
        $media = $this->mediaService->upload($request->file('logo'), 'settings');
        SiteSetting::setValue('logo', $media->file_path);

        return response()->json(['success' => true, 'path' => $media->url]);
    }

    public function getGroup(string $group): JsonResponse
    {
        $settings = SiteSetting::where('group', $group)->get()->pluck('value', 'key');
        return response()->json(['success' => true, 'data' => $settings]);
    }
}
