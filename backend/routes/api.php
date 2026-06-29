<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\FaqAdminController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\PageAdminController;
use App\Http\Controllers\Admin\PartnerAdminController;
use App\Http\Controllers\Admin\ProcessStepAdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TeamMemberAdminController;
use App\Http\Controllers\Admin\TestimonialAdminController;
use App\Http\Controllers\Public\BlogPublicController;
use App\Http\Controllers\Public\ContactPublicController;
use App\Http\Controllers\Public\FaqPublicController;
use App\Http\Controllers\Public\PagePublicController;
use App\Http\Controllers\Public\PartnersPublicController;
use App\Http\Controllers\Public\ProjectPublicController;
use App\Http\Controllers\Public\ServicesPublicController;
use App\Http\Controllers\Public\SiteSettingsPublicController;
use App\Http\Controllers\Public\TeamPublicController;
use App\Http\Controllers\Public\TestimonialsPublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    // Projects
    Route::get('projects', [ProjectPublicController::class, 'index']);
    Route::get('projects/featured', [ProjectPublicController::class, 'featured']);
    Route::get('projects/categories', [ProjectPublicController::class, 'categories']);
    Route::get('projects/{slug}', [ProjectPublicController::class, 'show']);

    // Services
    Route::get('services', [ServicesPublicController::class, 'index']);
    Route::get('services/{slug}', [ServicesPublicController::class, 'show']);

    // Blog
    Route::get('blog', [BlogPublicController::class, 'index']);
    Route::get('blog/featured', [BlogPublicController::class, 'featured']);
    Route::get('blog/categories', [BlogPublicController::class, 'categories']);
    Route::get('blog/{slug}', [BlogPublicController::class, 'show']);

    // Testimonials
    Route::get('testimonials', [TestimonialsPublicController::class, 'index']);
    Route::get('testimonials/featured', [TestimonialsPublicController::class, 'featured']);

    // Partners
    Route::get('partners', [PartnersPublicController::class, 'index']);

    // FAQs
    Route::get('faqs', [FaqPublicController::class, 'index']);

    // About — team, timeline, process
    Route::get('team', [TeamPublicController::class, 'team']);
    Route::get('timeline', [TeamPublicController::class, 'timeline']);
    Route::get('process-steps', [TeamPublicController::class, 'processSteps']);

    // Site settings (read-only)
    Route::get('settings', [SiteSettingsPublicController::class, 'index']);
    Route::get('settings/group/{group}', [SiteSettingsPublicController::class, 'getGroup']);

    // Pages (about, privacy…)
    Route::get('pages/{slug}', [PagePublicController::class, 'show']);

    // Contact & booking (rate-limited)
    Route::middleware('throttle:contact')->group(function () {
        Route::post('contact', [ContactPublicController::class, 'sendMessage']);
        Route::post('consultations', [ContactPublicController::class, 'bookConsultation']);
    });

    /*
    |--------------------------------------------------------------------------
    | Auth Routes (Admin)
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin/auth')->group(function () {
        Route::middleware('throttle:login')->group(function () {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
        });
        Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Protected Routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->middleware(['auth:sanctum', 'admin'])
        ->group(function () {

            // Auth
            Route::post('auth/logout', [AuthController::class, 'logout']);
            Route::get('auth/me', [AuthController::class, 'me']);

            // Projects
            Route::get('projects', [ProjectController::class, 'index']);
            Route::post('projects', [ProjectController::class, 'store']);
            Route::get('projects/{project}', [ProjectController::class, 'show']);
            Route::post('projects/{project}', [ProjectController::class, 'update']); // POST for multipart/form-data
            Route::delete('projects/{project}', [ProjectController::class, 'destroy']);
            Route::delete('projects/{project}/gallery/{index}', [ProjectController::class, 'removeGalleryImage']);
            Route::post('projects/reorder', [ProjectController::class, 'reorder']);

            // Blog
            Route::get('blog', [BlogPostController::class, 'index']);
            Route::post('blog', [BlogPostController::class, 'store']);
            Route::get('blog/{blogPost}', [BlogPostController::class, 'show']);
            Route::post('blog/{blogPost}', [BlogPostController::class, 'update']);
            Route::delete('blog/{blogPost}', [BlogPostController::class, 'destroy']);
            Route::get('blog-categories', [BlogPostController::class, 'categories']);
            Route::post('blog-categories', [BlogPostController::class, 'storeCategory']);

            // Services
            Route::apiResource('services', ServiceAdminController::class);

            // Testimonials
            Route::apiResource('testimonials', TestimonialAdminController::class);

            // FAQs
            Route::apiResource('faqs', FaqAdminController::class);

            // Partners
            Route::apiResource('partners', PartnerAdminController::class);

            // Process Steps
            Route::apiResource('process-steps', ProcessStepAdminController::class);

            // Team & Timeline
            Route::get('team', [TeamMemberAdminController::class, 'index']);
            Route::post('team', [TeamMemberAdminController::class, 'store']);
            Route::get('team/{teamMember}', [TeamMemberAdminController::class, 'show']);
            Route::post('team/{teamMember}', [TeamMemberAdminController::class, 'update']);
            Route::delete('team/{teamMember}', [TeamMemberAdminController::class, 'destroy']);
            Route::get('timeline', [TeamMemberAdminController::class, 'timelineIndex']);
            Route::post('timeline', [TeamMemberAdminController::class, 'timelineStore']);
            Route::put('timeline/{timelineEvent}', [TeamMemberAdminController::class, 'timelineUpdate']);
            Route::delete('timeline/{timelineEvent}', [TeamMemberAdminController::class, 'timelineDestroy']);

            // Site Settings
            Route::get('settings', [SiteSettingController::class, 'index']);
            Route::put('settings', [SiteSettingController::class, 'updateBulk']);
            Route::post('settings/logo', [SiteSettingController::class, 'uploadLogo']);
            Route::get('settings/group/{group}', [SiteSettingController::class, 'getGroup']);

            // Pages
            Route::get('pages', [PageAdminController::class, 'index']);
            Route::get('pages/{slug}', [PageAdminController::class, 'show']);
            Route::put('pages/{slug}', [PageAdminController::class, 'update']);

            // Contact Messages
            Route::get('messages', [ContactAdminController::class, 'messages']);
            Route::get('messages/{contactMessage}', [ContactAdminController::class, 'showMessage']);
            Route::patch('messages/{contactMessage}/status', [ContactAdminController::class, 'updateMessageStatus']);
            Route::delete('messages/{contactMessage}', [ContactAdminController::class, 'deleteMessage']);

            // Consultation Requests
            Route::get('consultations', [ContactAdminController::class, 'consultations']);
            Route::patch('consultations/{consultationRequest}/status', [ContactAdminController::class, 'updateConsultationStatus']);

            // Media Library
            Route::get('media', [MediaLibraryController::class, 'index']);
            Route::post('media', [MediaLibraryController::class, 'upload']);
            Route::patch('media/{mediaLibrary}', [MediaLibraryController::class, 'update']);
            Route::delete('media/{mediaLibrary}', [MediaLibraryController::class, 'destroy']);
        });
});
