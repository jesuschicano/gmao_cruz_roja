<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkTableInventario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventario', function (Blueprint $table) {
            // FOREIGN KEYS
            $table->foreign('id_lugar')
                    ->references('id')
                    ->on('lugares');
            $table->foreign('id_departamento')
                    ->references('id')
                    ->on('departamentos');
            $table->foreign('id_proveedor')
                    ->references('id')
                    ->on('proveedores');
            $table->foreign('id_motivo')
                    ->references('id')
                    ->on('motivos');
            $table->foreign('id_periodicidad')
                    ->references('id')
                    ->on('periodicidades');
            $table->foreign('id_empresa_mantenimiento')
                    ->references('id')
                    ->on('proveedores');
            $table->foreign('conjunto')
                    ->references('id')
                    ->on('conjuntos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventario', function (Blueprint $table) {
            //
        });
    }
}
