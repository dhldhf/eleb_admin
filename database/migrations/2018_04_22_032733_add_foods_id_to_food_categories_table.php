<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFoodsIdToFoodCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('food_categories', function (Blueprint $table) {
            $table->integer('foods_id')->unsigned();

            $table->foreign('foods_id')->references('food_id')->on('foods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food_categories', function (Blueprint $table) {
            $table->dropForeign(['foods_id']);
        });
    }
}
