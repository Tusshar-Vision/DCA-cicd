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
        Schema::table('notes', function (Blueprint $table) {
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->unsignedBigInteger('topic_section_id')->nullable();
            $table->unsignedBigInteger('topic_sub_section_id')->nullable();

            $table->foreign('topic_id')->references('id')->on('topic_sections');
            $table->foreign('topic_section_id')->references('id')->on('topic_sections');
            $table->foreign('topic_sub_section_id')->references('id')->on('topic_sub_sections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            //
        });
    }
};
