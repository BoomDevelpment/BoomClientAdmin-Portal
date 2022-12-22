<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenceZellesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transference_zelles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('identified')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->string('subject');
            $table->string('title');
            $table->string('date_trans', 50);
            $table->string('reference', 50);
            $table->double('total', 12, 2);
            $table->double('bs', 12, 2);
            $table->double('amount', 12, 2);
            $table->text('description');
            $table->integer('type_id')->unsigned();
            $table->integer('status_id')->unsigned()->default(1);
            $table->timestamps();
            
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('type_id')->references('id')->on('transference_types');
            $table->foreign('status_id')->references('id')->on('transference_statuses');

            $table->index(['identified']);
            $table->index(['subject']);
            $table->index(['title']);
            $table->index(['date_trans']);
            $table->index(['reference']);
            $table->index(['total']);
            $table->index(['bs']);
            $table->index(['amount']);
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
        Schema::dropIfExists('transference_zelles');
    }
}
