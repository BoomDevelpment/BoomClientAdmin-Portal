<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('mikrowisp')->unsigned()->default(16);
            $table->string('name');
            $table->string('birthday', 50);
            $table->text('address');
            $table->integer('estate_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('municipality_id')->unsigned();
            $table->integer('promotion_id')->unsigned();
            $table->string('latitude', 50);
            $table->string('longitude', 50);
            $table->string('phone_principal', 50);
            $table->string('phone_alternative', 50);
            $table->string('email_principal');
            $table->string('email_alternative');
            $table->integer('batch')->unsigned();
            $table->string('facebook');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('youtube');
            $table->string('advertising', 2)->default('SI');

            $table->integer('gender_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->timestamps();

            $table->foreign('estate_id')->references('id')->on('estates');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('promotion_id')->references('id')->on('promotions');

            $table->index(['mikrowisp']);
            $table->index(['name']);
            $table->index(['birthday']);
            $table->index(['phone_principal']);
            $table->index(['phone_alternative']);
            $table->index(['email_principal']);
            $table->index(['email_alternative']);
            $table->index(['batch']);
            $table->index(['facebook']);
            $table->index(['instagram']);
            $table->index(['twitter']);
            $table->index(['youtube']);
            $table->index(['advertising']);
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
        Schema::dropIfExists('clients');
    }
}
