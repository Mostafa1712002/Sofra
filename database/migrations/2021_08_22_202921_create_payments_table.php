<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id')->unsigned();
			$table->decimal('paid');
			$table->date('payment_date');
            $table->foreign("restaurant_id")->references("restaurant")->on("id")->cascadeOnDelete()->cascadeOnUpdate();
			$table->text('notes');
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}
