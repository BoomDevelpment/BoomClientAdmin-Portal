<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsRecurrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions_recurrences', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('promotion_id')->unsigned();
            $table->integer('month')->unsigned()->default(1);
            $table->double('cost', 12, 2);
            $table->double('mult', 12, 2);
            $table->double('iva', 12, 2);
            $table->double('total', 12, 2);
            $table->timestamps();

            $table->foreign('promotion_id')->references('id')->on('promotions');

            $table->index(['month']);
            $table->index(['cost']);
            $table->index(['mult']);
            $table->index(['iva']);
            $table->index(['total']);
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
        Schema::dropIfExists('promotions_recurrences');
    }
}
