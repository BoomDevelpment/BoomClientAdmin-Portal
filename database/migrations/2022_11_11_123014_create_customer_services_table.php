<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket');
            $table->integer('client_id')->unsigned();
            $table->integer('request_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->text('message');
            $table->integer('status_id')->unsigned();
            $table->integer('operator_id')->unsigned();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('request_id')->references('id')->on('customer_requests');
            $table->foreign('type_id')->references('id')->on('customer_types');
            $table->foreign('status_id')->references('id')->on('customer_statuses');
            $table->foreign('operator_id')->references('id')->on('operators');

            $table->index(['ticket']);
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
        Schema::dropIfExists('customer_services');
    }
}
