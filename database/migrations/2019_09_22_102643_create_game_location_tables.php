<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->time('time');
            $table->boolean('finalised');
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('adress_ln_1');
            $table->string('adress_ln_2');
            $table->string('town');
            $table->string('postcode');
            $table->longtext('notes');
            $table->timestamps();
        });

        Schema::table('games', function (Blueprint $table) {
            $table->integer('location_id')->unsigned()
            $table->foreign('location_id')->references('id')->on('locations')
        }

        Schema::create('game_user', function (Blueprint $table) {
            $table->integer('game_id')->unsigned()
            $table->foreign('game_id')->references('id')->on('games')
            $table->integer('user_id')->unsigned()
            $table->foreign('user_id')->references('id')->on('users')
            $table->boolean('attending')->default(0);
        })

        Schema::create('location_user', function (Blueprint $table) {
            $table->integer('location_id')->unsigned()
            $table->foreign('location_id')->references('id')->on('location')
            $table->integer('user_id')->unsigned()
            $table->foreign('user_id')->references('id')->on('users')
        })

        Schema::create('game_location', function (Blueprint $table){
            $table->integer('game_id')->unsigned()
            $table->foreign('game_id')->references('id')->on('games')
            $table->integer('location_id')->unsigned()
            $table->foreign('location_id')->references('id')->on('locations')
        })
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_location');
        Schema::dropIfExists('location_user');
        Schema::dropIfExists('game_user');
       
        Schema::dropForeign('games_location_id_foreign');

        Schema::dropIfExists('locations');
        Schema::dropIfExists('games');

    }
}
