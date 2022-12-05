<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->increments('id_quiz_answer');
            $table->integer('id_quiz')->unsigned();
            $table->string('jawab');
            $table->boolean('benar');
            $table->timestamps();

            $table->foreign('id_quiz')
            ->references('id_quiz')->on('quizzes')
            ->onUpate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_answers');
    }
}
