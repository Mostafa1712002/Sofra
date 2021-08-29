<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration {

	public function up()
	{
		Schema::create('order_product', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id')->unsigned();
			$table->integer('order_id')->unsigned();
			$table->integer('quantity');
			$table->decimal('price');
			$table->text('notes')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('order_product');
	}
}
