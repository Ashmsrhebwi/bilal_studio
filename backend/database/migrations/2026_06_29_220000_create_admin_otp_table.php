<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_otps', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('code', 6);
            $table->timestamp('expires_at');
            $table->boolean('used')->default(false);
            $table->integer('attempts')->default(0);
            $table->timestamps();
        });

        Schema::create('password_reset_tokens_custom', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_otps');
        Schema::dropIfExists('password_reset_tokens_custom');
    }
};
