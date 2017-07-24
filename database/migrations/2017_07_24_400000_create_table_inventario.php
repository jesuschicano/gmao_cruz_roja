<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInventario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->integer('id_lugar')->unsigned();
            $table->integer('id_departamento')->unsigned();
            $table->string('equipo');
            $table->string('marca');
            $table->string('modelo');
            $table->string('numero_serie');
            $table->integer('id_proveedor')->unsigned();
            $table->date('fecha_compra');
            $table->string('numero_factura');
            $table->string('asiento_contable');
            $table->double('precio', 15,2);// hasta 15 dígitos y 2 decimales
            $table->date('fecha_baja');
            $table->integer('id_motivo')->unsigned();
            $table->enum('tipo_mantenimiento', ['Preventivo', 'Correctivo']);
            $table->integer('id_periodicidad')->unsigned();
            $table->integer('id_empresa_mantenimiento')->unsigned();
            $table->double('importe_contrato', 15, 2);
            $table->date('fecha_ini_contrato');
            $table->date('fecha_renovacion_contrato');
            $table->string('comentarios');
            $table->integer('conjunto')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventario');
    }
}
