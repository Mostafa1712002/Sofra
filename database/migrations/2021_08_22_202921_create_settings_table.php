<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('about_us');
			$table->decimal('commission');
			$table->integer('num_bank_alahli');
			$table->integer('num_bank_alrakhi');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}