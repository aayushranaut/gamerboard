<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePsnUserUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('psn_user_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('psn_user_id')->unsigned()->index();
			$table->foreign('psn_user_id')->references('id')->on('psn_users')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('psn_user_user');
	}

}
