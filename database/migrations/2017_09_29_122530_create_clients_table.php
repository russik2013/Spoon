<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',228) ->nullable();
            $table->string('password',228) ->nullable();
            $table->text('firebaseID') ->nullable();
            $table->text('socialNetworkID') ->nullable();
            $table->string('firstName',228);
            $table->string('lastName',228) ->nullable();
            $table->string('middleName',228) ->nullable();
            $table->string('nickName',228) ->nullable();
            $table->string('sex',228)->default('ELSE');
            $table->integer('age')->default(-1);
            $table->string('photo',228) ->nullable();
            $table->boolean('reviewer') ->default(false);
            $table->integer('rating') ->default(0);
            $table->boolean('changePreferences') ->default(true);
            $table->string('token',228);
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
        Schema::dropIfExists('clients');
    }
}
