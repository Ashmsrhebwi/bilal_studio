<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestimonialsPublicController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('sort_order')
            ->paginate($request->integer('per_page', 12));

        return response()->json([
            'success' => true,
            'data'    => TestimonialResource::collection($testimonials->items()),
            'meta'    => [
                'total'    => $testimonials->total(),
                'last_page' => $testimonials->lastPage(),
            ],
        ]);
    }

    public function featured(): JsonResponse
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return response()->json(['success' => true, 'data' => TestimonialResource::collection($testimonials)]);
    }
}
