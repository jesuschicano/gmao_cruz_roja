<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Revision;
use App\Periodicidad;
use PDF;
// imprescindible agregar el facade DB
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Expression;

class PDFController extends Controller
{
	public function index(){
		return view('pdf.listados_informes');
	}

	public function crearPDF($datos, $vista){
		// procesamiento de datos [opcional por si hay que pasarle otra capa de proceso]
		$data = $datos;
		
		// generación de la vista
		$pdf = PDF::loadView( $vista, compact('data') );

		// lanzamos la descarga del fichero
		return $pdf->download('informe' . date('Y-m-d') . '.pdf');
	}

	public function crearInformeTodasRevisiones(){
		// preparación de los datos que se van a pasar
		$link = DB::connection('mysql2')->getDatabaseName();

    $revisiones = DB::table('revisiones')
                  ->join('inventario', 'inventario.id', '=', 'revisiones.id_item')
                  ->join(
                    new Expression($link.'.jos_huruhelpdesk_departments'),
                    'revisiones.id_depart',
                    '=',
                    new Expression($link.'.jos_huruhelpdesk_departments.department_id')
                    )
                  ->select('inventario.equipo',
                  new Expression($link.'.jos_huruhelpdesk_departments.dname'),
                  'descripcion',
                  'grado',
                  'ultima_rev',
                  'prox_rev',
                  'aviso')
                  ->get();

    // preparación de la ruta a la vista
    $vistaurl = 'pdf.reporte_todas_revisiones';

    // llamada a la función que genera el PDF
    return $this->crearPDF($revisiones, $vistaurl);
	}
}
