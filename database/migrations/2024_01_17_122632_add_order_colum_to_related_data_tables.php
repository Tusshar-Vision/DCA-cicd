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
        Schema::table('related_articles', function (Blueprint $table) {
            $table->unsignedInteger('order_column')->nullable()->default(null);
        });
        Schema::table('article_video_relation', function (Blueprint $table) {
            $table->unsignedInteger('order_column')->nullable()->default(null);
        });
        Schema::table('article_related_term', function (Blueprint $table) {
            $table->unsignedInteger('order_column')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('related_articles', function (Blueprint $table) {
            $table->dropColumn('order_column');
        });
        Schema::table('article_related_term', function (Blueprint $table) {
            $table->dropColumn('order_column');
        });
        Schema::table('article_video_relation', function (Blueprint $table) {
            $table->dropColumn('order_column');
        });
    }
};
