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
            $table->unsignedBigInteger('language_id')->after('name')->default(1);
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('published_initiatives', function (Blueprint $table) {
            $table->dropConstrainedForeignId('language_id');
        });
    }
};
