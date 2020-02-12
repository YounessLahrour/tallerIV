<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('categoria');
            $table->float('pvp', 6,2);
            $table->integer('stock');
            $table->string('imagen')->default('/img/articulos/default.jpg');
            $table->timestamps();
        });
    }
// id, nombre, categoria (Bazar, Hogar, Elećtronica), precio, stock, imagen
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
