<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('operator_id')->unsigned()->default(1);
            $table->integer('user_id')->unsigned()->default(1);
            $table->timestamps();
            
            $table->foreign('operator_id')->references('id')->on('operators');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operator_users');
    }
}
