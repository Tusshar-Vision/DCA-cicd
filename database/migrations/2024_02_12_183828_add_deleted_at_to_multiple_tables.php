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
        Schema::table('infographics', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('initiatives', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('initiative_topics', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('infographics', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('initiatives', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('initiative_topics', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
