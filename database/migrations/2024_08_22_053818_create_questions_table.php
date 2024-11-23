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
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // Primary key: id (auto-incrementing integer)
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('chapter_id');
            $table->unsignedBigInteger('language_id');
            $table->string('lesson'); // Lesson (varchar)
            $table->text('question_text'); // The actual question (text)
            $table->string('option1'); // Option 1 (varchar)
            $table->string('option2'); // Option 2 (varchar)
            $table->string('option3'); // Option 3 (varchar)
            $table->string('option4'); // Option 4 (varchar)
            $table->string('correct_ans'); // Correct answer (e.g., option1, option2, etc.)
            $table->enum('difficulty_level', ['easy', 'medium', 'hard']); // Difficulty level (enum)
            $table->boolean('paid_status')->default(0); //  (1 for paid, 0 for free)

            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
