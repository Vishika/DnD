<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('name')->unique();
            $table->unsignedBigInteger('gold')->default(0);
            $table->unsignedBigInteger('experience')->default(6500);
            $table->unsignedInteger('level')->default(5);
            $table->string('race');
            $table->string('class');
            $table->boolean('active')->default(true);
            $table->text('note');
            $table->text('dm_note');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}