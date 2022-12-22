<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('mikrowisp');
            $table->integer('client_id')->unsigned();

            $table->integer('rating_id')->unsigned();
            $table->integer('rating_answer_id')->unsigned();

            $table->integer('attention_id')->unsigned();
            $table->integer('attention_answer_id')->unsigned();

            $table->integer('hand_id')->unsigned();
            $table->integer('hand_answer_id')->unsigned();

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');

            $table->foreign('rating_id')->references('id')->on('survey_questions');
            $table->foreign('rating_answer_id')->references('id')->on('survey_options_questions');

            $table->foreign('attention_id')->references('id')->on('survey_questions');
            $table->foreign('attention_answer_id')->references('id')->on('survey_options_questions');

            $table->foreign('hand_id')->references('id')->on('survey_questions');
            $table->foreign('hand_answer_id')->references('id')->on('survey_options_questions');

            $table->index(['mikrowisp']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}
