<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transference_files', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('identified')->unsigned();
            $table->string('name');
            $table->string('dir_name');
            $table->timestamps();
            
            $table->index(['identified']);
            $table->index(['name']);
            $table->index(['dir_name']);
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
        Schema::dropIfExists('transference_files');
    }
}
