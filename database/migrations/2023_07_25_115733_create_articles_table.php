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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->unsignedInteger('read_time')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->enum('visibility', ['public', 'private', 'restricted'])->default('public');
            $table->enum('language', ['hindi', 'english'])->default('english');
            $table->boolean('featured')->default(false);
            $table->json('sources')->nullable();


            $table->unsignedBigInteger('author_id'); // * Foreign key column for the author relationship
            $table->unsignedBigInteger('reviewer_id')->nullable(); // * Foreign key column for the author relationship
            $table->unsignedBigInteger('initiative_id'); // * Foreign key column for the initiative relationship
            $table->unsignedBigInteger('published_initiative_id');
            $table->unsignedBigInteger('initiative_topic_id'); // * Foreign key column for the initiative topic relationship
            $table->unsignedBigInteger('topic_section_id')->nullable();
            $table->unsignedBigInteger('topic_sub_section_id')->nullable();

            $table->dateTime('published_at');
            $table->timestamps();
            $table->unsignedInteger('order_column')->nullable()->default(null);

            $table->fullText('title');
            $table->fullText('content');

            // * Define foreign key relationship with the above tables
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('reviewer_id')->references('id')->on('users');
            $table->foreign('initiative_id')->references('id')->on('initiatives');
            $table->foreign('published_initiative_id')->references('id')->on('published_initiatives');
            $table->foreign('initiative_topic_id')->references('id')->on('initiative_topics');
            $table->foreign('topic_section_id')->references('id')->on('topic_sections');
            $table->foreign('topic_sub_section_id')->references('id')->on('topic_sub_sections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
