<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('about_us');
			$table->decimal('commission');
			$table->string('num_bank_alahli',100);
			$table->string('num_bank_alrakhi',100);
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}