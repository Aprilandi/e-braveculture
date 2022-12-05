<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_histories', function (Blueprint $table) {
            $table->increments('id_history');
            $table->integer('id_user')->unsigned();
            $table->integer('id_reward')->unsigned();
            $table->string('status')->default('Unclaimed');
            $table->date('expired_at');
            $table->timestamps();

            $table->foreign('id_user')
            ->references('id_user')->on('users')
            ->onUpdate('cascade')
            ->onDelete('restrict');
            $table->foreign('id_reward')
            ->references('id_reward')->on('rewards')
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
        Schema::dropIfExists('reward_histories');
    }
}
