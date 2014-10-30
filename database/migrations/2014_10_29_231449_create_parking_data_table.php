<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parking_data', function($table)
		{
			$table->increments('id');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->string("location_id");
			$table->integer("timestamp");
			$table->date("collection_date");
			$table->time("collection_time");
			$table->string("state");
			$table->integer("capacity");
			$table->integer("used");
			$table->integer("free_00");
			$table->integer("free_30");
			$table->integer("free_60");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('parking_data');
	}

}
