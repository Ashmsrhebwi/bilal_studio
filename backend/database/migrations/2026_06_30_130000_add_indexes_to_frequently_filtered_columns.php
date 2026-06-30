<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('project_categories', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->index('group');
        });
    }

    public function down(): void
    {
        Schema::table('projects', fn (Blueprint $table) => $table->dropIndex(['status']));
        Schema::table('project_categories', fn (Blueprint $table) => $table->dropIndex(['is_active']));
        Schema::table('services', fn (Blueprint $table) => $table->dropIndex(['is_active']));
        Schema::table('blog_posts', fn (Blueprint $table) => $table->dropIndex(['status']));
        Schema::table('blog_categories', fn (Blueprint $table) => $table->dropIndex(['is_active']));
        Schema::table('testimonials', fn (Blueprint $table) => $table->dropIndex(['is_active']));
        Schema::table('partners', fn (Blueprint $table) => $table->dropIndex(['is_active']));
        Schema::table('faqs', fn (Blueprint $table) => $table->dropIndex(['is_active']));
        Schema::table('pages', fn (Blueprint $table) => $table->dropIndex(['is_active']));
        Schema::table('site_settings', fn (Blueprint $table) => $table->dropIndex(['group']));
    }
};
