<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice')->unsigned();
            $table->text('description');
            $table->double('cantidad', 12, 2);
            $table->integer('unit')->unsigned();
            $table->double('tax', 12, 2);
            $table->timestamps(); 
            
            $table->index(['invoice']);
            $table->index(['cantidad']);
            $table->index(['unit']);
            $table->index(['tax']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices_items');
    }
}
