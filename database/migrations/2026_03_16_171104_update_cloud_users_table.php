<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cloud_users', function (Blueprint $table) {
            $table->integer('fetched_assets')->nullable();
            $table->integer('downloaded_assets')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('cloud_users', function (Blueprint $table) {
            $table->dropColumn('fetched_assets', 'downloaded_assets');
        });
    }
};
