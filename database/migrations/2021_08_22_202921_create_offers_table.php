<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('image');
			$table->text('descripation');
			$table->date('date_to');
			$table->date('date_from');
			$table->integer('restaurant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}