<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Proveedor;
// imprescindible agregar el facade DB
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Storage;

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

		return view('insertarticuloForm', ['lugares'=>$lugares,
																'departamentos'=>$departamentos,
																'proveedores'=>$proveedores,
																'motivos'=>$motivos]);
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
		$item->id_empresa_mantenimiento = $request->input('emp_mantenimiento');

		// almacenamiento del contrato
		$contrato = $request->file('file_contrato');

		$ext = $contrato->extension();
		// generar la fecha para  ponerle un nombre
		$hoy = getdate();
		$y = $hoy["year"];
		$m = $hoy["mon"];
		$d = $hoy["mday"];

		$contrato->storeAs('contratos/' . $item->codigo, 'contrato' . $y . $m . $d . '.' . $ext);
		// el storeAs guarda el contrato con el nombre "contrato-FechaDeHoy.ExtQueTenga"
		// dentro de la carpeta contratos/

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
		// +
		// cerciorarnos de que tiene algo que enviar al form
		$itemProv = DB::table('proveedores')
								->where('id', $data->id_proveedor)
								->get();
		if( count($itemProv) == 0 ){
			$itemProv = null;
		}
		// recogida de los proveedores
		$proveedores = DB::table('proveedores')->get();

		// recogida de los motivos especificos del item
		$itemMot = DB::table('motivos')
								->where('id', $data->id_motivo)
								->get();
		if( count($itemMot) == 0 ){
			$itemMot = null;
		}
		// recogida de los motivos
		$motivos = DB::table('motivos')->get();


		// recogida de la empresa de mantenimiento encargada de
		// el item en concreto
		$itemMant = DB::table('proveedores')
								->where('id', $data->id_empresa_mantenimiento)
								->get();
		if( count($itemMant) == 0 ){
			$itemMant = null;
		}

		// recogida de todos los contratos subidos para este articulo
		$contratos = Storage::disk('public')->allFiles('contratos/' . $data->codigo);
		dd($contratos);
		return view('editforminventario', [
																		'datos'=>$data,
																		'itemLugar'=>$itemLugar[0],
																		'lugares'=>$lugares,
																		'itemDep'=>$itemDept[0],
																		'departamentos'=>$departamentos,
																		'itemProv'=>$itemProv,
																		'proveedores'=>$proveedores,
																		'itemMot'=>$itemMot,
																		'motivos'=>$motivos,
																		'itemMant'=>$itemMant,
																		'contratos'=>$contratos
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
		$item->id_empresa_mantenimiento = $request->input('emp_mantenimiento');
		$item->importe_contrato = $request->input('importe_contrato');
		$item->fecha_ini_contrato = $request->input('inicio_contrato');
		$item->fecha_renovacion_contrato = $request->input('renovacion_contrato');
		$item->comentarios = $request->input('comentarios');
		$item->save();
		return redirect('inventario');
	}
}
