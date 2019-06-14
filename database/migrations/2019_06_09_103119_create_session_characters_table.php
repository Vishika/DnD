<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('session_id');
            $table->bigInteger('character_id');
            $table->enum('difficulty', ['easy', 'role play', 'medium', 'hard', 'deadly'])->default('medium');
            $table->integer('duration')->default(0);
            $table->integer('encounters')->default(0);
            $table->unsignedBigInteger('experience')->default(0);
            $table->unsignedBigInteger('gold')->default(0);
            $table->string('note')->nullable();
            $table->boolean('dm')->default(false);
            $table->timestamps();
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->foreign('character_id')->references('id')->on('characters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_characters');
    }
}
