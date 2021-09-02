<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration {

	public function up()
	{
		Schema::create('districts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->integer('city_id')->unsigned();
            $table->foreign("city_id")->references("id")->on("cities")->restrictOnDelete()->cascadeOnUpdate();
		});
	}

	public function down()
	{
		Schema::drop('districts');
	}
}
