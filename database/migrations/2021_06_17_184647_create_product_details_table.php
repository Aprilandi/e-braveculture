<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->increments('id_product_detail');
            $table->integer('id_product')->unsigned();
            $table->integer('id_product_size')->unsigned();
            $table->integer('product_stock');
            $table->integer('product_weight');
            $table->timestamps();

            $table->foreign('id_product')
            ->references('id_product')->on('products')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_product_size')
            ->references('id_product_size')->on('product_sizes')
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
        //
    }
}
