<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTransactionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_transaction_payments', function (Blueprint $table) {
            $table->increments('id_sale_payments');
            $table->integer('id_sale')->unsigned();
            $table->string('bukti_pembayaran')->nullable();
            $table->integer('pembayaran');
            $table->timestamps();

            $table->foreign('id_sale')
            ->references('id_sale')->on('sale_transactions')
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
        Schema::dropIfExists('sale_transaction_payments');
    }
}
