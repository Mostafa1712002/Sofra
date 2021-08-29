<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->timestamps();
			$table->increments('id');
			$table->string('title', 255);
			$table->text('content');
			$table->integer('order_id');
			$table->integer('notifiable_id')->unsigned();
			$table->string('notifiable_type', 255);
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}