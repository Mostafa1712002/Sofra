<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('image');
			$table->text('description');
            
			$table->date('date_to');
			$table->date('date_from');
			$table->integer('restaurant_id')->unsigned();
            $table->foreign("restaurant_id")->references("restaurant")->on("id")->cascadeOnDelete()->cascadeOnUpdate();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}