<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePsnUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psn_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('avatar_url');
            $table->integer('level');
            $table->integer('progress');
            $table->integer('trophies');
            $table->integer('bronze');
            $table->integer('silver');
            $table->integer('gold');
            $table->integer('platinum');
            $table->unique('username');
            $table->index('username');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('psn_users');
    }

}
