<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyReferredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_referreds', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('phones');
            $table->integer('client_id')->unsigned();
            $table->integer('survey_id')->unsigned();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('survey_id')->references('id')->on('surveys');

            $table->index(['name']);
            $table->index(['phones']);
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
        Schema::dropIfExists('survey_referreds');
    }
}
