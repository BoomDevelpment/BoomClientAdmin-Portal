<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('src');
            $table->integer('status_id')->unsigned();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statuses');

            $table->index(['name']);
            $table->index(['src']);
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
        Schema::dropIfExists('voucher_images');
    }
}
