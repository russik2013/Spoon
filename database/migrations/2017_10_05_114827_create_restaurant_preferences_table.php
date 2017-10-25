<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('AMERICAN')->default(0);
            $table->integer('ASIAN')->default(0);
            $table->integer('BAR')->default(0);
            $table->integer('BURGER')->default(0);
            $table->integer('CAFE')->default(0);
            $table->integer('CHINESE')->default(0);
            $table->integer('DESSERT')->default(0);
            $table->integer('ITALIAN')->default(0);
            $table->integer('JAPANESE')->default(0);
            $table->integer('MEXICAN')->default(0);
            $table->integer('PIZZA')->default(0);
            $table->integer('SEAFOOD')->default(0);
            $table->integer('STEAKHOUSE')->default(0);
            $table->integer('SUSHI')->default(0);
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
        Schema::dropIfExists('restaurant_preferences');
    }
}
