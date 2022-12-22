<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_banks', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('last',8);
            $table->binary('cypher');
            $table->string('keygen');
            $table->integer('bank_id')->unsigned()->default(1);
            $table->integer('key_id')->unsigned()->default(1);
            $table->integer('type_id')->unsigned()->default(1);
            $table->integer('entity_id')->unsigned()->default(1);
            $table->integer('status_id')->unsigned()->default(1);
            $table->integer('client_id')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('key_id')->references('id')->on('account_bank_keys');
            $table->foreign('type_id')->references('id')->on('account_bank_types');
            $table->foreign('entity_id')->references('id')->on('account_bank_entities');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('client_id')->references('id')->on('clients');

            $table->index(['name']);
            $table->index(['last']);
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
        Schema::dropIfExists('account_banks');
    }
}
