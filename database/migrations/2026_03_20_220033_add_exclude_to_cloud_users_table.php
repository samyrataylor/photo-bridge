<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cloud_users', function (Blueprint $table) {
            $table->json('exclude_albums')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('cloud_users', function (Blueprint $table) {
            $table->dropColumn('exclude_albums');
        });
    }
};
