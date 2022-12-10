<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_transactions', function (Blueprint $table) {
            $table->increments('id_order');
            $table->integer('id_user')->unsigned();
            $table->integer('id_colour')->unsigned();
            $table->integer('id_voucher')->unsigned()->nullable();
            $table->string('alamat_penuh');
            $table->integer('total_quantity');
            $table->integer('sub_total');
            $table->string('kurir');
            $table->string('paket');
            $table->integer('shipping_fee');
            $table->integer('total');
            $table->integer('dp');
            $table->string('status_bayar');
            $table->integer('perolehan_points');
            $table->integer('bonus_points');
            $table->integer('persentase_bonus');
            $table->string('status');
            $table->string('model_3d_json');
            $table->double('canvas_height', 100, 2);
            $table->string('canvas_width', 100, 2);
            $table->string('no_resi')->nullable();
            $table->timestamps();

            $table->foreign('id_user')
            ->references('id_user')->on('users')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_colour')
            ->references('id_colour')->on('colours')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_voucher')
            ->references('id_history')->on('reward_histories')
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
        Schema::dropIfExists('order_transactions');
    }
}
