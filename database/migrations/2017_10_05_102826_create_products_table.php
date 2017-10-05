<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurants_id');
            $table->foreign('restaurants_id')
                ->references('id')
                ->on('restaurants');
            $table->string('name', 228);
            $table->text('description');
            $table->string('kitchen',228);
            $table->string('category',228);
            $table->float('prise');
            $table->float('weight');
            $table->string('unit_of_measurement',228);
            $table->integer('cooking_time');
            $table->float('rating');
            $table->text('ingredients');
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
        Schema::dropIfExists('products');
    }
}
