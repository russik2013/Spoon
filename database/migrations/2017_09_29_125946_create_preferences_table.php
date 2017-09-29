<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('AMERICAN')->default(50);
            $table->integer('ASIAN')->default(50);
            $table->integer('BAR')->default(50);
            $table->integer('BURGER')->default(50);
            $table->integer('CAFE')->default(50);
            $table->integer('CHINESE')->default(50);
            $table->integer('DESSERT')->default(50);
            $table->integer('ITALIAN')->default(50);
            $table->integer('JAPANESE')->default(50);
            $table->integer('MEXICAN')->default(50);
            $table->integer('PIZZA')->default(50);
            $table->integer('SEAFOOD')->default(50);
            $table->integer('STEAKHOUSE')->default(50);
            $table->integer('SUSHI')->default(50);
            $table->integer('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('preferences');
    }
}
