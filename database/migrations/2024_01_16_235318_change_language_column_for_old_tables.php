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
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('language_id')->default(1);
            $table->foreign('language_id')->references('id')->on('languages');

            $table->dropColumn('language');
        });

        Schema::table('infographics', function (Blueprint $table) {
            $table->unsignedBigInteger('language_id')->default(1);
            $table->foreign('language_id')->references('id')->on('languages');

            $table->dropColumn('language');
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->unsignedBigInteger('language_id')->default(1);
            $table->foreign('language_id')->references('id')->on('languages');

            $table->dropColumn('language');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('language_id');
        });
        Schema::table('infographics', function (Blueprint $table) {
            $table->dropConstrainedForeignId('language_id');
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('language_id');
        });
    }
};
