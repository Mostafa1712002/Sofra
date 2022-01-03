<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
            $table->tinyInteger("active");
			$table->string('name', 255);
			$table->string('email', 255)->unique();
			$table->string('password', 255);
			$table->string('pin_code', 255)->nullable();
			$table->string('phone', 255);
			$table->string('image');
			$table->integer('district_id')->unsigned();
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
