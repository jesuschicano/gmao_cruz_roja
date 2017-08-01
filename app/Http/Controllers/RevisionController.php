<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Revision;
// imprescindible agregar el facade DB
use Illuminate\Support\Facades\DB;

class RevisionController extends Controller
{
  /**
  * funcion que recibe la id del item seleccionado para listar sus revisiones
  * @vars $id
  */
  public function getIndex($id){
    // recoger qué item es para mostrar el nombre
    $nombre = Inventario::find($id);
    $nombre = $nombre->equipo;

    // sacar un listado con las revisiones que tenga
    $query = Revision::where('id_item', $id)->get();
    if( count($query) == 0 ){
      return view('listrevisiones', ['nombre'=>$nombre]);
    }else{
      return view('listrevisiones', ['nombre'=>$nombre, 'revisiones'=>$query]);
    }
  }

}
