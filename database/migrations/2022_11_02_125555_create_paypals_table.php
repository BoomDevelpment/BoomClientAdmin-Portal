<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client')->nullable();
            $table->string('secret')->nullable();
            $table->string('mode')->nullable();
            $table->integer('status_id')->unsigned()->default(1);
            $table->timestamps();
            
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->index(['client']);
            $table->index(['secret']);
            $table->index(['mode']);
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
        Schema::dropIfExists('paypals');
    }
}
