<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizSessionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_session_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id')->index();
            $table->unsignedBigInteger('question_id')->index();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->unsignedBigInteger('selected_choice_id')->index();
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
        Schema::dropIfExists('quiz_session_answers');
    }
}
