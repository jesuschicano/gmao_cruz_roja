<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function(Blueprint $table){
            $table->increments('id');
            $table->string('codigo');
            $table->string('nif');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('poblacion');
            $table->string('provincia');
            $table->string('telefono');
            $table->string('comercial')->nullable();
            $table->string('observaciones')->nullable();
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
        Schema::drop('proveedores');
    }
}
