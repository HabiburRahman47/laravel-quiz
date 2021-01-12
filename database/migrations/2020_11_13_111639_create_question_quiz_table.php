<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_quiz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id')->nullable()->index();
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->unsignedBigInteger('question_id')->nullable()->index();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->unsignedBigInteger('created_by_id')->index();
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question__quiz');
    }
}
