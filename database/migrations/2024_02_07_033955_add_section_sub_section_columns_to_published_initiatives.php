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
            $table->unsignedBigInteger('topic_section_id')->nullable();
            $table->unsignedBigInteger('topic_sub_section_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('published_initiatives', function (Blueprint $table) {
            $table->dropConstrainedForeignId('topic_section_id');
            $table->dropConstrainedForeignId('topic_sub_section_id');
        });
    }
};
