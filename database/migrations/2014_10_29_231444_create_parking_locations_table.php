<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parking_locations', function($table)
		{
			$table->increments('id');
			$table->string("location_id");
			$table->string("woeid");
			$table->string("city");
			$table->string("name");
			$table->string("image_url");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('parking_locations');
	}

}
