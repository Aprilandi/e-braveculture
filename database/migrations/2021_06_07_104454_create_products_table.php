<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id_product');
            $table->string('product_name');
            $table->string('product_desc');
            $table->integer('product_price');
            $table->string('product_edition')->nullable();
            $table->integer('id_product_type')->unsigned();
            $table->integer('id_material')->unsigned();
            $table->integer('product_discount')->default(0);
            $table->timestamps();

            $table->foreign('id_product_type')
            ->references('id_product_type')->on('product_types')
            ->onUpdate('cascade')
            ->onDelete('restrict');

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
        Schema::dropIfExists('products');
    }
}
