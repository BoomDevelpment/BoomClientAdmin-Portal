<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('mw_id')->unsigned();
            $table->integer('invoice')->unsigned();
            $table->string('emitted', 50);
            $table->string('expired', 50);
            $table->double('amount', 12, 2);
            $table->double('total', 12, 2);
            $table->string('paid', 50);
            $table->integer('status_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('status_id')->references('id')->on('invoices_statuses');
            $table->foreign('type_id')->references('id')->on('invoices_types');

            $table->index(['mw_id']);
            $table->index(['emitted']);
            $table->index(['expired']);
            $table->index(['paid']);
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
        Schema::dropIfExists('invoices');
    }
}
