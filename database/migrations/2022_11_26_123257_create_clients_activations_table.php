<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsActivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_activations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('month')->unsigned();
            $table->double('cost', 12, 2);
            $table->double('mult', 12, 2);
            $table->double('iva', 12, 2);
            $table->double('total', 12, 2);
            $table->string('month_date')->nullable();
            $table->string('invoice_date')->nullable();
            $table->integer('status_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('status_id')->references('id')->on('recurrence_statuses');
            
            $table->index(['month_date']);
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
        Schema::dropIfExists('clients_activations');
    }
}
