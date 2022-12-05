<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->increments('id_reward');
            $table->integer('id_reward_type')->unsigned();
            $table->string('value');
            $table->string('desc');
            $table->integer('prize_point');
            $table->integer('hari_berlaku');
            $table->integer('id_level')->unsigned();
            $table->timestamps();

            $table->foreign('id_reward_type')
            ->references('id_reward_type')->on('reward_types')
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
        Schema::dropIfExists('rewards');
    }
}
