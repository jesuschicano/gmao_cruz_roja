<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRevisiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('revisiones', function (Blueprint $table) {
        $table->increments('id');
        /* vinculación con el item de la BD */
        $table->integer('id_item')->unsigned();
        $table->foreign('id_item')
                ->references('id')
                ->on('inventario')
                ->onDelete('cascade');
        /* los grados solo serán numerales */
        $table->integer('grado')->nullable();
        /* bloque fechas revisiones */
        $table->date('ultima_rev')->nullable();
        $table->date('prox_rev')->nullable();
        $table->integer('period')->nullable();
        $table->date('aviso')->nullable();

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
      $table->dropForeign('id_item');
      Schema::dropIfExists('revisiones');
    }
}
