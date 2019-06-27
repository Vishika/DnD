<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnchantmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enchantments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('rarity', ['common', 'uncommon', 'rare', 'very rare', 'legendary']);
            $table->enum('type', ['weapon', 'armour', 'shield', 'headwear', 'cloak', 'footwear', 'amulet', 'ring', 'misc']);
            $table->string('restrictions')->nullable();
            $table->string('brief_description');
            $table->text('long_description');
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
        Schema::dropIfExists('enchantments');
    }
}
