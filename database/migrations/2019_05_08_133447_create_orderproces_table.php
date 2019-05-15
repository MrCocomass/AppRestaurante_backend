<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderprocesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderproces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_order');
            $table->string('order_date');
            $table->string('order_totalprice');

            $table->string('id_food');
            $table->string('food_price');
            $table->string('food_imagen');
            $table->string('food_description');
            $table->string('food_name');
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
        Schema::dropIfExists('orderproces');
    }
}
