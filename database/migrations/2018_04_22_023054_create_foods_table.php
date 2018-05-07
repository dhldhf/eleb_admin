<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('food_name');
            $table->string('rating');
            $table->string('food_price');
            $table->string('description');
            $table->string('month_sales');
            $table->string('rating_count');
            $table->string('tips');
            $table->string('satisfy_count');
            $table->string('satisfy_rate');
            $table->string('goods_img');
            $table->integer('food_id');
            $table->integer('shop_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
