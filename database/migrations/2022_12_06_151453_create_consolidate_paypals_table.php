<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolidatePaypalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidate_paypals', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('report_date');
            $table->string('report_code');
            $table->double('report_amount', 12,2)->default(0.00);
            $table->integer('client_id')->unsigned();
            $table->integer('transaction_id')->unsigned();
            $table->integer('transference_id')->unsigned();
            $table->string('transference_date');
            $table->string('transference_code');
            $table->double('transference_total', 12, 2)->default(0.00);
            $table->integer('status_id')->unsigned();
            $table->integer('operator_id')->unsigned();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('transference_id')->references('id')->on('transference_paypals');
            $table->foreign('status_id')->references('id')->on('transference_statuses');
            $table->foreign('operator_id')->references('id')->on('operators');

            $table->index(['report_date']);
            $table->index(['report_code']);
            $table->index(['report_amount']);
            $table->index(['transaction_id']);
            $table->index(['transference_date']);
            $table->index(['transference_code']);
            $table->index(['transference_total']);
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
        Schema::dropIfExists('consolidate_paypals');
    }
}
