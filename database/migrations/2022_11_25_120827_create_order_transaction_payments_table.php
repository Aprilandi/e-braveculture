<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTransactionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_transaction_payments', function (Blueprint $table) {
            $table->increments('id_order_payments');
            $table->integer('id_order')->unsigned();
            $table->string('bukti_pembayaran')->nullable();
            $table->integer('pembayaran');
            $table->timestamps();

            $table->foreign('id_order')
            ->references('id_order')->on('order_transactions')
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
        Schema::dropIfExists('order_transaction_payments');
    }
}
