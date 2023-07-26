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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key column for the user relationship
            $table->unsignedBigInteger('article_id'); // Foreign key column for the article relationship
            $table->text('content'); // Content of the comment
            $table->boolean('approved')->default(false); // Whether the comment is approved by admin
            $table->timestamps();
            
            // Define foreign key relationships with the 'users' and 'articles' tables
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
