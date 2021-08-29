<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255)->unique();
			$table->string('email', 255);
			$table->string('phone', 255);
            $table->string("pin_code",255)->nullable();
			$table->tinyInteger('state')->default('0');
			$table->decimal('minimum');
			$table->string('image_restaurant', 255);
			$table->string('whats_app', 255)->unique();
			$table->string('phone_restaurant', 255)->index();
			$table->decimal('delivery_fee');
			$table->integer('district_id')->unsigned();
			$table->string('image', 255);
			$table->string('password', 255);
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
