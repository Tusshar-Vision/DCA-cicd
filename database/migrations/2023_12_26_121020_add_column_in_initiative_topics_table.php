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
        Schema::table('initiative_topics', function (Blueprint $table) {
            $table->unsignedBigInteger('paper_id')->default(1);

            $table->foreign('paper_id')->references('id')->on('papers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('initiative_topics', function (Blueprint $table) {
            $table->dropColumn('paper_id');
        });
    }
};
