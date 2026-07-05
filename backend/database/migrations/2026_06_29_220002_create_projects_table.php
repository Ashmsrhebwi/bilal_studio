<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('project_categories')->onDelete('restrict');
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('slug')->unique();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->string('location_ar')->nullable();
            $table->string('location_en')->nullable();
            $table->decimal('area', 10, 2)->nullable();
            $table->year('year')->nullable();
            $table->json('services_ar')->nullable();
            $table->json('services_en')->nullable();
            $table->string('cover_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('before_image')->nullable();
            $table->string('after_image')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('status')->default('draft');
            $table->integer('sort_order')->default(0);
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
