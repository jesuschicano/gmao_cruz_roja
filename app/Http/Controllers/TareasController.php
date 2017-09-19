<?php

namespace App\Http\Controllers;

use App\Tarea;
use App\User;
use App\Inventario;
use Illuminate\Http\Request;

class TareasController extends Controller
{
  /**
  * $id = el identificador del item
  **/
  public function add($id){
    // Regocer tareas asignadas a este id
    // junto con el nombre de su ususario
    $tareas = Tarea::where('id_item', $id)
    ->join('users', 'tareas.id_usuario', '=', 'users.id')
    ->select('tareas.id','tareas.tarea','users.name')
    ->get();
    // Recoger todos los 'empleados'
    $empleados = User::where('role', 3)->get();
    //

    if( $tareas->count() != 0 ){
      return view('insertformtarea', ['empleados'=>$empleados,'tareas'=>$tareas,'id_item'=>$id]);
    }else{
      return view('insertformtarea', ['empleados'=>$empleados, 'id_item'=>$id])
      ->withErrors(
        ['Aún no hay tareas asignadas. Inserta nuevas tareas en el siguiente formulario.']
      );
    }
  }

  public function store(Request $request){
    $tarea = new Tarea;
    $tarea->id_item = $request->input('id_item');
    $tarea->id_usuario = $request->input('usuario');
    $tarea->tarea = $request->input('tarea');
    $tarea->save();
    return back();
  }

  public function modify($id){
    // Recoger la tarea que coincida con el id
    $tarea = Tarea::find($id);
    // Recoger todos los usuarios
    $empleados = User::where('role', 3)->get();
    return view('editformtarea', ['tarea'=>$tarea, 'empleados'=>$empleados]);
  }

  public function update(Request $request){
    $tarea = Tarea::find($request->input('id'));
    $tarea->id_usuario = $request->input('usuario');
    $tarea->tarea = $request->input('tarea');
    $tarea->save();
    return redirect('tareas/add/'.$tarea->id_item);
  }

  public function destroy($id){
    Tarea::destroy($id);
    return back();
  }

  public function asignadas($id_user){
    // recoger las tareas asignadas a este usuario
    // diferenciadas por nombre de equipo
    $tareas = Tarea::where('id_usuario', $id_user)
    ->join('inventario', 'id_item', '=', 'inventario.id')
    ->select('inventario.id','inventario.equipo')
    ->distinct('inventario.equipo')
    ->get();
    return view('checktareas', ['tareas'=>$tareas]);
  }

  public function check($id_item, $id_user){
    // preparar listado de tareas según id_item
    // y pertenezcan al usuario logueado
    $list = Tarea::where([
      ['id_item', $id_item],
      ['id_usuario', $id_user]
    ])->get();
    // se envía también el id_item para reportar el problema si lo hay
    return view('todo', ['list'=>$list, 'id_item'=>$id_item]);
  }

}
