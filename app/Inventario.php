<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
	protected $table = "inventario";
	protected $primaryKey = "id";
	protected $fillable = [
		"codigo",
		"equipo",
		"marca",
		"modelo",
		"numero_serie",
		"fecha_compra",
		"numero_factura",
		"asiento_contable",
		"precio",
		"fecha_baja",
		"importe_contrato",
		"fecha_ini_contrato",
		"fecha_renovacion_contrato",
		"comentarios",
	];
}
