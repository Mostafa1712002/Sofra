<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
            $table->tinyInteger("active");
			$table->text('description');
            $table->string("image");
			$table->decimal('price');
			$table->decimal('price_offer');
			$table->time('request_time');
			$table->integer('restaurant_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
