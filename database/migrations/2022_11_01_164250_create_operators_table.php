<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('username');
            $table->integer('ext_pr')->unsigned()->default(0);
            $table->integer('ext_vz')->unsigned()->default(0);
            $table->integer('ext_us')->unsigned()->default(0);
            $table->integer('role_id')->unsigned()->default(1);
            $table->integer('status_id')->unsigned()->default(1);
            $table->timestamps();
            
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->index(['name']);
            $table->index(['username']);
            $table->index(['ext_pr']);
            $table->index(['ext_vz']);
            $table->index(['ext_us']);
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
        Schema::dropIfExists('operators');
    }
}
