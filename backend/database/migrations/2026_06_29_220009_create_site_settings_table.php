<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string'); // string, json, boolean, image
            $table->string('group')->default('general');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_ar');
            $table->string('title_en');
            $table->longText('content_ar')->nullable();
            $table->longText('content_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('media_library', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type'); // image, video, document
            $table->string('mime_type');
            $table->unsignedBigInteger('file_size');
            $table->string('thumbnail_path')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('alt_text_ar')->nullable();
            $table->string('alt_text_en')->nullable();
            $table->string('disk')->default('public');
            $table->morphs('mediable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_library');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('site_settings');
    }
};
