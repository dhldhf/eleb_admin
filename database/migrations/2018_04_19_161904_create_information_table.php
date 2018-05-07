<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shop_name');
            $table->string('shop_img');
            $table->string('shop_rating');
            $table->string('service_code');
            $table->string('foods_code');
            $table->string('high_or_low');
            $table->string('h_l_percent');
            $table->string('brand');
            $table->string('on_time');
            $table->string('fengniao');
            $table->string('bao');
            $table->string('piao');
            $table->string('zhun');
            $table->string('start_send');
            $table->string('send_cost');
            $table->string('distance');
            $table->string('estimate_time');
            $table->string('notice');
            $table->string('discount');
            $table->string('evaluate');
            $table->string('user_id');
            $table->string('username');
            $table->string('user_img');
            $table->string('time');
            $table->string('evaluate_code');
            $table->string('send_time');
            $table->string('evaluate_details');
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
        Schema::dropIfExists('information');
    }
}
