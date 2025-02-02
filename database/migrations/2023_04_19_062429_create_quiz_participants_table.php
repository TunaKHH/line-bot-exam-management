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
        Schema::create('quiz_participants', function (Blueprint $table) {
            $table->id();
            $table->string('user_line_id')->comment('使用者的line id');
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('last_question_index')->default(0)->comment('上次一題的索引');
            $table->boolean('is_completed')->default(false);
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_participants');
    }
};
