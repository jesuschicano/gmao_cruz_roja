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
}
