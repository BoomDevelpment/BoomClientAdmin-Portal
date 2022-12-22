<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferencePendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transference_pendings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('identified')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('transaction')->unsigned();
            $table->integer('method_id')->unsigned();
            $table->integer('status_id')->unsigned()->default(1);
            $table->timestamps();
            
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('method_id')->references('id')->on('transference_methods');
            $table->foreign('status_id')->references('id')->on('transference_statuses');

            $table->index(['identified']);
            $table->index(['transaction']);
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
        Schema::dropIfExists('transference_pendings');
    }
}
