<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('address', 255);
            $table->enum('payment_method', array('cash', 'online'));
            $table->enum('state', array('pending', 'accepted', 'rejected', 'delivered', 'declined',"finished"));
            $table->decimal('price')->nullable();
            $table->integer('client_id')->unsigned();
            $table->integer('restaurant_id')->unsigned();
            $table->decimal('cost')->nullable();
            $table->decimal('delivery_cost')->nullable();
            $table->decimal('total')->nullable();
            $table->decimal('commission')->nullable();
            $table->text("notes");
            $table->date("insert_time");
            $table->decimal('net')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('orders');
    }
}
