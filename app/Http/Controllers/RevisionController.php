<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Revision;
use App\Periodicidad;
// imprescindible agregar el facade DB
use Illuminate\Support\Facades\DB;

class RevisionController extends Controller
{
  /**
  * funcion que recibe la id del item seleccionado para listar sus revisiones
  * @var id
  */
  public function getIndex($id){
    // recoger qué item es para mostrar el nombre
    $item = Inventario::find($id);

    // sacar un listado con las revisiones que tenga
    $query = Revision::where('id_item', $id)->get();
    if( count($query) == 0 ){
      return view('listrevisiones', ['item'=>$item]);
    }else{
      return view('listrevisiones', ['item'=>$item, 'revisiones'=>$query]);
    }
  }

  /**
  * funcion que recibe el id del item para presentar un formulario
  * específico a sus revisiones
  * @var id
  */
  public function create($id){
    $data = Inventario::find($id);
    $periodos = Periodicidad::all();
    $departamentos = DB::connection('mysql2')
						->table('jos_huruhelpdesk_departments')
						->get();
    return view('insertformrevision', ['datos'=>$data,
                                        'periodos'=>$periodos,
                                        'depart'=>$departamentos]);
  }

  /**
  * funcion para guardar la revisión dado el id del ITEM
  * y los datos de los inputs recogidos en el form anterior
  * @var id, request
  */
  public function save($id, Request $request){
    //guardar todos los campos
    $item = new Revision;
    $item->id_item = $id;
    $item->descripcion = $request->input('descripcion');
    $item->period = $request->input('periodo');
    $item->grado = $request->input('grado');
    $item->id_depart = $request->input('dep');
    $item->ultima_rev = $request->input('rev_actual');
    $item->prox_rev = $request->input('prox_rev');
    $item->aviso = $request->input('aviso_rev');
    //guardar en la tabla
    $item->save();
    return redirect('inventario');
  }

  /**
  * función que elimina la revisión seleccionada en la tabla
  */
  public function destroy($id){
    Revision::destroy($id);
    return redirect('inventario');
  }

  public function edit($id){
    $revision = Revision::find($id);
    $item = DB::table('inventario')->where('id', $revision->id_item)->first();
    $periodos = Periodicidad::all();
    $departamentos = DB::connection('mysql2')->table('jos_huruhelpdesk_departments')->get();
    $rev_dept = DB::connection('mysql2')->table('jos_huruhelpdesk_departments')
                ->select('dname')->where('department_id', '=', $revision->id_depart)->first();

    return view('editformrevision', ['item'=>$item,
                                        'revision' => $revision,
                                        'periodos'=>$periodos,
                                        'rev_dep'=>$rev_dept,
                                        'depart'=>$departamentos]);
  }
  public function update($id, Request $request){}
}
