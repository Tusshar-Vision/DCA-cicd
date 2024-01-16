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
            $table->unsignedBigInteger('initiative_topic_id')->after('is_published')->nullable(); // * Foreign key column for the initiative topic relationship
            $table->foreign('initiative_topic_id')->references('id')->on('initiative_topics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('published_initiatives', function (Blueprint $table) {
            $table->dropConstrainedForeignId('initiative_topic_id');
        });
    }
};
