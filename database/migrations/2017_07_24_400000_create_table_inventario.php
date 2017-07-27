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
            $table->string('equipo')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('numero_serie')->nullable();
            $table->integer('id_proveedor')->nullable()->unsigned();
            $table->date('fecha_compra')->nullable();
            $table->string('numero_factura')->nullable();
            $table->string('asiento_contable')->nullable();
            $table->double('precio', 15,2)->nullable();// hasta 15 dígitos y 2 decimales
            $table->date('fecha_baja')->nullable();
            $table->integer('id_motivo')->nullable()->unsigned();
            $table->enum('tipo_mantenimiento', ['Preventivo', 'Correctivo']);
            $table->integer('id_periodicidad')->nullable()->unsigned();
            $table->integer('id_empresa_mantenimiento')->nullable()->unsigned();
            $table->double('importe_contrato', 15, 2)->nullable();
            $table->date('fecha_ini_contrato')->nullable();
            $table->date('fecha_renovacion_contrato')->nullable();
            $table->string('comentarios')->nullable();
            $table->integer('conjunto')->nullable()->unsigned();
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
        Schema::drop('inventario');
    }
}
