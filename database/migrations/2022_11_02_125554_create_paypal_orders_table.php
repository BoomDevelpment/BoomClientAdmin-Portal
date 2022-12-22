<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('identified')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->string('order_id');
            $table->string('currency')->default('USD');
            $table->double('amount',12,2)->default('0.00');
            $table->double('tax',12,2)->default('0.00');
            $table->double('total',12,2)->default('0.00');
            $table->string('link');
            $table->string('status')->nullable();
            $table->string('paypal_client')->nullable();
            $table->string('paypal_email')->nullable();
            $table->double('gross_amount',12,2)->default('0.00')->nullable();
            $table->double('paypal_fee',12,2)->default('0.00')->nullable();
            $table->double('net_amount',12,2)->default('0.00')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');

            $table->index(['identified']);
            $table->index(['invoice_id']);
            $table->index(['order_id']);
            $table->index(['currency']);
            $table->index(['amount']);
            $table->index(['tax']);
            $table->index(['total']);
            $table->index(['status']);
            $table->index(['paypal_client']);
            $table->index(['gross_amount']);
            $table->index(['paypal_fee']);
            $table->index(['paypal_email']);
            $table->index(['net_amount']);
            $table->index(['transaction_id']);
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
        Schema::dropIfExists('paypal_orders');
    }
}
