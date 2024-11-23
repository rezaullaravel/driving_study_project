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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('licence_type_id');
            $table->integer('chapter_id');
            $table->integer('language_id');
            $table->string('lesson');
            $table->string('topic_name');
            $table->text('topic_description');
            $table->text('video_url')->nullable();
            $table->integer('paid_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
