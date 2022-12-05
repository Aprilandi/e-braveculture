<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->increments('id_review');
            $table->integer('id_product')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->string('review');
            $table->integer('score');
            $table->timestamps();

            $table->foreign('id_product')
            ->references('id_product')->on('products')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table->foreign('id_user')
            ->references('id_user')->on('users')
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
        Schema::dropIfExists('product_reviews');
    }
}
