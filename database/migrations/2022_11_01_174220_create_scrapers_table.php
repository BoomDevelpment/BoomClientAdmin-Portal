<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScrapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrapers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->double('dolar', 12,2);
            $table->double('euro', 12,2);
            $table->double('yuan', 12,2);
            $table->double('lira', 12,2);
            $table->double('rublo', 12,2);
            $table->double('paralelo', 12,2);
            $table->integer('status_id')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statuses');

            $table->index(['dolar']);
            $table->index(['euro']);
            $table->index(['yuan']);
            $table->index(['lira']);
            $table->index(['rublo']);
            $table->index(['paralelo']);
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
        Schema::dropIfExists('scrapers');
    }
}
