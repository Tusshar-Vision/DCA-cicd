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
        Schema::create('initiative_topics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('initiative_id');
            $table->string('name');

            // * Define foreign key relationship with the 'articles' table
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('initiative_id')->references('id')->on('initiatives');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initiative_topics');
    }
};
