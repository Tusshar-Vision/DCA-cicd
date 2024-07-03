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
            $table->unsignedBigInteger('infographic_id')->nullable();
            $table->foreign('infographic_id')->references('id')->on('infographics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('published_initiatives', function (Blueprint $table) {
            $table->dropConstrainedForeignId('infographic_id');
        });
    }
};
