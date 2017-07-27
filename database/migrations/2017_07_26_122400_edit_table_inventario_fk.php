<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTableInventarioFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventario', function (Blueprint $table) {
            // el resto de foráneas si van a la BD por defecto
            $table->foreign('id_proveedor')
                    ->references('id')
                    ->on('proveedores')
                    ->onDelete('cascade');
            $table->foreign('id_motivo')
                    ->references('id')
                    ->on('motivos')
                    ->onDelete('cascade');
            $table->foreign('id_periodicidad')
                    ->references('id')
                    ->on('periodicidades')
                    ->onDelete('cascade');
            $table->foreign('id_empresa_mantenimiento')
                    ->references('id')
                    ->on('proveedores')
                    ->onDelete('cascade');
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
            $table->dropForeign([
                'id_proveedor',
                'id_motivo',
                'id_periodicidad',
                'id_empresa_mantenimiento',
                ]);
        });
    }
}
