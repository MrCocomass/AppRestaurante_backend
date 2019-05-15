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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('imagen')->nullable();
            $table->string('price');
            $table->timestamps();
        });

        $user = new App\Foods();
        $user->price = '2';
        $user->description = 'Ración para una persona de papas';
        $user->name = 'Papas';
        $user->save();

        $user = new App\Foods();
        $user->price = '3,50';
        $user->description = 'Hamburguesa con carne de vacuno con queso, tomate, lechuga, cebolla, ketchup y mostaza';
        $user->name = 'hamburguesa de la casa';
        $user->save();

        $user = new App\Foods();
        $user->price = '2,50';
        $user->description = 'Sandwich con lechuga, tomate, huevo, mayonesa y atun';
        $user->name = 'Sandwich vegetal';
        $user->save();

    }

    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
