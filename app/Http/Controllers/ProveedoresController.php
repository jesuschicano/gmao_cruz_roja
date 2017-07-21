<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;

class ProveedoresController extends Controller
{
	/**
	* Devuelve el listado de todos los proveedores
	**/
	public function getIndex(){
		$proveedores = Proveedor::all();
		return view('proveedores', ['proveedores' => $proveedores]);
	}

	/**
	* Muestra el formulario de insercion nuevo proveedor
	*/
	public function insertForm(){
		return view('insertformproveedor');
	}

	/**
	* Guarda un proveedor
	**/
	public function insert(Request $request){
		// Instanciar un nuevo objeto proveedor
		$proveedor = new Proveedor;
		// Recoger datos de los campos input
		$proveedor->codigo = $request->codigo;
    $proveedor->nif = $request->nif;
    $proveedor->nombre = $request->nombre;
		$proveedor->direccion = $request->direccion;
		$proveedor->poblacion = $request->poblacion;
		$proveedor->provincia = $request->provincia;
		$proveedor->telefono = $request->telefono;
		$proveedor->comercial = $request->comercial;
		$proveedor->observaciones = $request->observaciones;
		// guardar los datos en la BD
		$proveedor->save();
		// redirigir al indice
		return redirect('proveedores');
	}

	/**
	* Borra el proveedor escogido
	**/
	public function borra($id){
		Proveedor::destroy($id);
		return redirect('proveedores');
	}

	/**
	* Carga primero el formulario con los datos que se van a editar
	**/
	public function preEdit($id){
		// se busca el proveedor en la BD
		// si es solo por primary keys se puede usar 
		// Eloquent para ejecutar la sentencia find()
		$proveedor = Proveedor::find($id);
		if( !empty($proveedor) ){
			return view("editformproveedor", ["item" => $proveedor]);
		}else{
			return "No se ha encontrado el proveedor especificado";
		}
	}

	public function editar(Request $request, $id){
		// Búsqueda del proveedor a editar
		$search = Proveedor::find($id);
		// asignación
		$search->codigo = $request->codigo;
    $search->nif = $request->nif;
    $search->nombre = $request->nombre;
		$search->direccion = $request->direccion;
		$search->poblacion = $request->poblacion;
		$search->provincia = $request->provincia;
		$search->telefono = $request->telefono;
		$search->comercial = $request->comercial;
		$search->observaciones = $request->observaciones;

		// guardar la nueva actualización
		$search->save();
		return redirect("proveedores");
	}
}
