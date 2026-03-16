<?php

use App\Models\CloudUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CloudUser::class);
            $table->string('name');
            $table->boolean('fetch')->default(true);
            $table->boolean('download')->default(true);
            $table->boolean('import')->default(true);
            $table->integer('fetched_assets')->nullable();
            $table->integer('downloaded_assets')->nullable();
            $table->integer('imported_assets')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
