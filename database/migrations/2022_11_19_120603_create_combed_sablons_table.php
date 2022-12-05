<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombedSablonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combed_sablons', function (Blueprint $table) {
            $table->increments('id_combed');
            $table->integer('id_material')->unsigned();
            $table->string('combed');
            $table->integer('harga');
            $table->timestamps();

            $table->foreign('id_material')
            ->references('id_material')->on('materials')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combed_sablons');
    }
}
