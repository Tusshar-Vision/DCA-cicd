<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('published_initiatives', function (Blueprint $table) {
            $table->unsignedBigInteger('video_id')->nullable();
            $table->foreign('video_id')->references('id')->on('videos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('published_initiatives', function (Blueprint $table) {
            $table->dropConstrainedForeignId('video_id');
        });
    }
};
