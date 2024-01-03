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
        Schema::table('read_histories', function (Blueprint $table) {
            $table->dateTime('article_published_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('read_histories', function (Blueprint $table) {
            $table->dropColumn('article_published_at');
        });
    }
};
