<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration {

	public function up()
	{
		Schema::create('tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('token', 255);
			$table->enum('platform', array('android', 'ios'));
			$table->integer('tokable_id')->unsigned();
			$table->string('tokable_type', 255);
		});
	}

	public function down()
	{
		Schema::drop('tokens');
	}
}
