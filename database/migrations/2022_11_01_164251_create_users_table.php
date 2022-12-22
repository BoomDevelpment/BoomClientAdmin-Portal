<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('identified');
            $table->integer('profile_id')->unsigned()->default(1);
            $table->integer('status_id')->unsigned()->default(1);
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->index(['name']);
            $table->index(['username']);
            $table->index(['email']);
            $table->index(['identified']);
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
        Schema::dropIfExists('users');
    }
}
