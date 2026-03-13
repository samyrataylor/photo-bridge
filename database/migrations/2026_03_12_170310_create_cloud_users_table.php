<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cloud_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name')->unique()->nullable();
            $table->string('apple_email')->unique();
            $table->string('apple_password')->nullable();
            $table->string('apple_cookie_path')->nullable();
            $table->string('immich_email')->nullable();
            $table->string('immich_api_key')->nullable();
            $table->timestamp('last_successful_login')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cloud_users');
    }
};
