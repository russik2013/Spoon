<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RestaurantPasswordResetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_password_reset', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('kod');
            $table->integer('restaurants_id');
            $table->foreign('restaurants_id')
                ->references('id')
                ->on('restaurants');
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
        Schema::dropIfExists('restaurant_password_reset');
    }
}
