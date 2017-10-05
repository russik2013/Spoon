<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 228);
            $table->string('password', 228);
            $table->string('name', 228);
            $table->string('nets', 228) ->nullable();
            $table->string('category', 228);
            $table->text('description');
            $table->string('phone', 228);
            $table->integer('average_check');
            $table->boolean('verified') ->default(false);
            $table->boolean('specify_time');
            $table->string('monday') ->default('00:00-00:01');
            $table->string('tuesday') ->default('00:00-00:01');
            $table->string('wednesday') ->default('00:00-00:01');
            $table->string('thursday') ->default('00:00-00:01');
            $table->string('friday') ->default('00:00-00:01');
            $table->string('saturday') ->default('00:00-00:01');
            $table->string('sunday') ->default('00:00-00:01');
            $table->text('reviewer_review') ->nullable();
            $table->string('address',228);
            $table->string('location',228);
            $table->integer('rating') ->default(0);
            $table->boolean('display_tables') ->default(false);
            $table->integer('number_of_free_tables') ->default(-1);
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
        Schema::dropIfExists('restaurants');
    }
}
