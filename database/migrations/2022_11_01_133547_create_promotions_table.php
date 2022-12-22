<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('subtitle');
            $table->double('cost', 12, 2);
            $table->double('iva_cost', 12, 2);
            $table->double('inst', 12, 2);
            $table->double('iva_inst', 12, 2);
            $table->integer('estate_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('technology_id')->unsigned();
            $table->string('date_ini', 50);
            $table->string('date_end', 50);
            $table->integer('status_id')->unsigned();
            $table->timestamps();

            $table->foreign('estate_id')->references('id')->on('estates');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('technology_id')->references('id')->on('promotions_technologies');
            $table->foreign('type_id')->references('id')->on('promotions_types');
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->index(['title']);
            $table->index(['subtitle']);
            $table->index(['cost']);
            $table->index(['iva_cost']);
            $table->index(['inst']);
            $table->index(['iva_inst']);
            $table->index(['date_ini']);
            $table->index(['date_end']);
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
        Schema::dropIfExists('promotions');
    }
}
