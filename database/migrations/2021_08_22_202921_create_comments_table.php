<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('id');
			$table->text('content');
			$table->enum('rating', array('star1', 'star2', 'star3', 'star4', 'star5'));
			$table->integer('client_id')->unsigned();
			$table->integer('restaurant_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('comments');
	}
}
