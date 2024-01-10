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
        Schema::table('videos', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id'); // * Foreign key column for the author relationship
            $table->enum('language', ['hindi', 'english'])->default('english');
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('initiative_topic_id'); // * Foreign key column for the initiative topic relationship
            $table->unsignedBigInteger('topic_section_id')->nullable();
            $table->unsignedBigInteger('topic_sub_section_id')->nullable();

            $table->foreign('author_id')->references('id')->on('users');
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
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn([
                'author_id',
                'language',
                'views',
                'initiative_topic_id',
                'topic_section_id',
                'topic_sub_section_id'
            ]);
        });
    }
};
