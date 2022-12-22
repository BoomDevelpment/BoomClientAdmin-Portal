<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('url');
            $table->string('image');
            $table->integer('request_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->timestamps();

            $table->foreign('request_id')->references('id')->on('customer_requests');
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->index(['url']);
            $table->index(['image']);
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
        Schema::dropIfExists('customer_types');
    }
}
