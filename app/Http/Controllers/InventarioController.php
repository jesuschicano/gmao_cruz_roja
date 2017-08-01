<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Proveedor;
// imprescindible agregar el facade DB
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Expression;

class InventarioController extends Controller
{
	public function getIndexOld(){
		// tenemos que conectarnos a otra BD
		// y mostrar los datos que queramos en la query
		$query = DB::connection('mysql2')
						->table('jos_huruhelpdesk_inventory')
						->get();
		return view('inventarioOld', ['items' => $query]);
	}

	public function getIndex(){
		// conexión a la base externa como nexo para los nombres de tablas
		$link = DB::connection('mysql2')->getDatabaseName();

		/* es necesario hacer dos left join para mostrar los nombres
		 tanto de los lugares como de los departamentos
		 teniendo como base la tabla INVENTARIO que contiene los
		 campos identificadores de cada una de las otras dos tablas
		 exteriores*/
		/*******************************/
		/* Justo después efectuar el select con los datos reales que
		queremos llevarnos a la vista.*/
		$data = DB::table('inventario')
						->leftJoin(new Expression($link.'.jos_huruhelpdesk_places') ,
							'inventario.id_lugar' ,
							'=' ,
							new Expression($link.'.jos_huruhelpdesk_places.id'))
						->leftJoin(new Expression($link.'.jos_huruhelpdesk_departments') ,
							'inventario.id_departamento' ,
							'=' ,
							new Expression($link.'.jos_huruhelpdesk_departments.department_id'))
						->select('inventario.id','inventario.codigo','inventario.equipo',
							new Expression($link.'.jos_huruhelpdesk_places.name'),
							new Expression($link.'.jos_huruhelpdesk_departments.dname'))
						->get();

		return view('inventario', ['datos'=>$data]);
	}

	public function create(){
		// recogida de los lugares
		$lugares = DB::connection('mysql2')
							->table('jos_huruhelpdesk_places')
							->get();
		// recogida de los departamentos
		$departamentos = DB::connection('mysql2')
							->table('jos_huruhelpdesk_departments')
							->orderBy('dname','asc')
							->get();
		// recogida de los proveedores
		$proveedores = DB::table('proveedores')->get();
		// recogida de los motivos
		$motivos = DB::table('motivos')->get();
		// recogida de las periodicidades
		$periodicidades = DB::table('periodicidades')->get();

		return view('insertarticuloForm', ['lugares'=>$lugares,
																'departamentos'=>$departamentos,
																'proveedores'=>$proveedores,
																'motivos'=>$motivos,
																'periodicidades'=>$periodicidades]);
	}

	public function store(Request $request){
		// instanciar
		$item = new Inventario;
		$item->codigo = $request->input('codigo');
		$item->id_lugar = $request->input('lugar');
		$item->id_departamento = $request->input('departamento');
		$item->equipo = $request->input('equipo');
		$item->marca = $request->input('marca');
		$item->modelo = $request->input('modelo');
		$item->numero_serie = $request->input('serie');
		$item->id_proveedor = $request->input('proveedor');
		$item->fecha_compra = $request->input('fecha_compra');
		$item->numero_factura = $request->input('num_factura');
		$item->asiento_contable = $request->input('asiento');
		$item->precio = $request->input('precio');
		$item->fecha_baja = $request->input('fecha_baja');
		$item->id_motivo = $request->input('motivo');
		$item->tipo_mantenimiento = $request->input('mantenimiento');
		$item->id_periodicidad = $request->input('periodicidad');
		$item->id_empresa_mantenimiento = $request->input('emp_mantenimiento');
		$item->importe_contrato = $request->input('importe_contrato');
		$item->fecha_ini_contrato = $request->input('inicio_contrato');
		$item->fecha_renovacion_contrato = $request->input('renovacion_contrato');
		$item->comentarios = $request->input('comentarios');
		$item->save();
		return redirect('inventario');
	}

	public function destroy($id){
		Inventario::destroy($id);
		return redirect('inventario');
	}

	/**
	* Función que carga el formulario de edición con los datos
	* ya registrados del artículo seleccionado
	*/
	public function edit($id){
		// localizar el item a modificar
		$data = Inventario::find($id);

		// recogida del lugar concreto donde está el item
		$itemLugar = DB::connection('mysql2')
								->table('jos_huruhelpdesk_places')
								->where('id', $data->id_lugar)
								->get();
		// recogida de los lugares
		$lugares = DB::connection('mysql2')
							->table('jos_huruhelpdesk_places')
							->get();

		// recogida del departamento concreto donde está el item
		$itemDept = DB::connection('mysql2')
								->table('jos_huruhelpdesk_departments')
								->where('department_id',$data->id_departamento)
								->get();
		// recogida de los departamentos
		$departamentos = DB::connection('mysql2')
							->table('jos_huruhelpdesk_departments')
							->orderBy('dname','asc')
							->get();

		// recogida del proveedor al que pertenece el item
		$itemProv = DB::table('proveedores')
								->where('id', $data->id_proveedor)
								->get();
		// recogida de los proveedores
		$proveedores = DB::table('proveedores')->get();

		// recogida de los motivos especificos del item
		$itemMot = DB::table('motivos')
								->where('id', $data->id_motivo)
								->get();
		// recogida de los motivos
		$motivos = DB::table('motivos')->get();

		// recogida de los periodos del item en concreto
		$itemPeriod = DB::table('periodicidades')
									->where('id', $data->id_periodicidad)
									->get();
		// recogida de las periodicidades
		$periodicidades = DB::table('periodicidades')->get();

		// recogida de la empresa de mantenimiento encargada de
		// el item en concreto
		$itemMant = DB::table('proveedores')
								->where('id', $data->id_empresa_mantenimiento)
								->get();

		//dd($itemMant[0]);
		return view('editforminventario', [
																		'datos'=>$data,
																		'itemLugar'=>$itemLugar[0],
																		'lugares'=>$lugares,
																		'itemDep'=>$itemDept[0],
																		'departamentos'=>$departamentos,
																		'itemProv'=>$itemProv[0],
																		'proveedores'=>$proveedores,
																		'itemMot'=>$itemMot[0],
																		'motivos'=>$motivos,
																		'itemPeriod'=>$itemPeriod[0],
																		'periodicidades'=>$periodicidades,
																		'itemMant'=>$itemMant[0]
																	]);
	}

	public function update(Request $request, $id){
		$item = Inventario::find($id);
		$item->codigo = $request->input('codigo');
		$item->id_lugar = $request->input('lugar');
		$item->id_departamento = $request->input('departamento');
		$item->equipo = $request->input('equipo');
		$item->marca = $request->input('marca');
		$item->modelo = $request->input('modelo');
		$item->numero_serie = $request->input('serie');
		$item->id_proveedor = $request->input('proveedor');
		$item->fecha_compra = $request->input('fecha_compra');
		$item->numero_factura = $request->input('num_factura');
		$item->asiento_contable = $request->input('asiento');
		$item->precio = $request->input('precio');
		$item->fecha_baja = $request->input('fecha_baja');
		$item->id_motivo = $request->input('motivo');
		$item->tipo_mantenimiento = $request->input('mantenimiento');
		$item->id_periodicidad = $request->input('periodicidad');
		$item->id_empresa_mantenimiento = $request->input('emp_mantenimiento');
		$item->importe_contrato = $request->input('importe_contrato');
		$item->fecha_ini_contrato = $request->input('inicio_contrato');
		$item->fecha_renovacion_contrato = $request->input('renovacion_contrato');
		$item->comentarios = $request->input('comentarios');
		$item->save();
		return redirect('inventario');
	}
}
