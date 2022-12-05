<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_transaction_details', function (Blueprint $table) {
            $table->increments('id_sale_detail');
            $table->integer('id_sale')->unsigned();
            $table->integer('id_product')->unsigned();
            $table->integer('id_product_size')->unsigned();
            $table->integer('product_quantity');
            $table->timestamps();

            $table->foreign('id_sale')
            ->references('id_sale')->on('sale_transactions')
            ->onUpdate('cascade')
            ->onDelete('restrict');

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
        Schema::dropIfExists('sale_transaction_details');
    }
}
