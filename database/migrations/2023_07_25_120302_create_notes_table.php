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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index(); // * Foreign key column for the user relationship
            $table->unsignedBigInteger('article_id')->index(); // * Foreign key column for the article relationship
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->unsignedBigInteger('topic_section_id')->nullable();
            $table->unsignedBigInteger('topic_sub_section_id')->nullable();

            $table->text("title");
            $table->timestamps();

            // * Define foreign key relationships with the 'users' and 'articles' tables
            $table->foreign('topic_id')->references('id')->on('topic_sections');
            $table->foreign('topic_section_id')->references('id')->on('topic_sections');
            $table->foreign('topic_sub_section_id')->references('id')->on('topic_sub_sections');
            $table->foreign('user_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
