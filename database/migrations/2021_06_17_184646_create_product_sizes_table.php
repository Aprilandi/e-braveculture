<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->increments('id_product_size');
            $table->integer('id_product_type')->unsigned();
            $table->string('product_size');
            $table->string('umur');
            $table->string('kelamin');
            $table->string('ukuran');
            $table->timestamps();

            $table->foreign('id_product_type')
            ->references('id_product_type')->on('product_types')
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
        Schema::dropIfExists('product_sizes');
    }
}
