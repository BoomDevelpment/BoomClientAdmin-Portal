<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('ticket', 50);
            $table->double('amount', 12, 2);
            $table->double('total', 12, 2);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');

            $table->index(['ticket']);
            $table->index(['amount']);
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
        Schema::dropIfExists('voucher_logs');
    }
}
