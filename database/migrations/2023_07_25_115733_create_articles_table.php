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
            $table->text('content');
            $table->date('publication_date')->nullable();
            $table->string('url_slug')->unique();
            $table->string('featured_image')->nullable();
            $table->text('excerpt')->nullable();
            $table->unsignedInteger('read_time')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('likes')->default(0);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->enum('visibility', ['public', 'private', 'restricted'])->default('public');
            $table->enum('language', ['hindi', 'english'])->default('english');
            $table->string('seo_meta_title')->nullable();
            $table->text('seo_meta_description')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->decimal('rating', 3, 2)->nullable();
            $table->timestamp('last_updated')->nullable();
            
            $table->unsignedBigInteger('tag_id'); // * Foreign key column for the article tag relationship
            $table->unsignedBigInteger('comment_id'); // * Foreign key column for the comment relationship
            $table->unsignedBigInteger('author_id'); // * Foreign key column for the author relationship
            $table->unsignedBigInteger('initiative_id'); // * Foreign key column for the initiative / category relationship

            // * Define foreign key relationship with the above tables
            $table->foreign('tag_id')->references('id')->on('article_tags');
            $table->foreign('comment_id')->references('id')->on('comments');
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('initiative_id')->references('id')->on('initiatives');
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
