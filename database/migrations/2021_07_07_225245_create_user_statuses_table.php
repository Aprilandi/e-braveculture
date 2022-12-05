<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_statuses', function (Blueprint $table) {
            $table->increments('id_user_status');
            $table->integer('id_user')->unsigned();
            $table->integer('id_level')->unsigned();
            $table->integer('experience_points')->default('0');
            $table->integer('redeemable_points')->default('0');
            $table->integer('redeemable_points_pending')->default('0');
            $table->timestamps();

            $table->foreign('id_user')
            ->references('id_user')->on('users')
            ->onUpdate('cascade')
            ->onDelete('restrict');
            $table->foreign('id_level')
            ->references('id_level')->on('levels')
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
        Schema::dropIfExists('user_statuses');
    }
}
