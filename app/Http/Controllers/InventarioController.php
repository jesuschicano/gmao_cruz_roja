<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// imprescindible agregar el facade DB
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
	public function getIndex(){
		// tenemos que conectarnos a otra BD
		// y mostrar los datos que queramos en la query
		$query = DB::connection('mysql2')
						->table('jos_huruhelpdesk_inventory')
						->select('equipo')
						->get();
		return view('inventario', ['departamentos' => $query]);
	}
}
