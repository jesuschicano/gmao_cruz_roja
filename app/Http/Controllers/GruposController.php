<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Inventario;
use App\Grupo;

class GruposController extends Controller
{
  public function index(){
    // get all items which grupo=1
    $list = Inventario::where('grupo', 1)->get();
    return view('grupos', ['grupos' => $list]);
  }

  public function edit($id){
    // coger todos los items que pertenecen al grupo
    $list1 = DB::table('grupos')
      ->join('inventario', 'inventario.id', '=', 'grupos.id_hijo')
      ->where('grupos.id_padre', '=', $id)
      ->select('grupos.id_padre','inventario.id','inventario.codigo','inventario.equipo')->get();
      // AGREGAR MÁS EN EL SELECT PARA LUEGO PODER ELIMINAR

    // coger todos los items del inventario que no sean padres
    $list2 = Inventario::where('grupo', 0)->get();
    // enviar a la vista con los datos
    return view('gruposadd', ['list1'=>$list1, 'list2'=>$list2, 'padre'=>$id]);
  }

  public function add($padre, $hijo){
    // se recibe el inventario.id que será el nuevo grupo.id_hijo
    $newItem = new Grupo;
    $newItem->id_padre = $padre;
    $newItem->id_hijo = $hijo;
    $newItem->save();
    return back();
  }

  public function remove($padre, $hijo){
    // búsqueda de la tupla que coincida el padre y el hijo
    $search = Grupo::where([
      ['id_padre', '=', $padre],
      ['id_hijo', '=', $hijo]
    ]);
    $search->delete();
    return back();
  }
}
