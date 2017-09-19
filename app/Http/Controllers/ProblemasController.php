<?php

namespace App\Http\Controllers;

use App\Problema;
use App\Inventario;
use App\User;
use Illuminate\Http\Request;
use DB;

class ProblemasController extends Controller
{

  public function index()
  {
    $pro = DB::table('problemas')
    ->join('inventario', 'problemas.id_item', '=', 'inventario.id')
    ->select('problemas.id', 'problemas.comentario', 'inventario.equipo', 'problemas.created_at')
    ->get();
    return view('problemaslistado', ['problemas'=>$pro]);
  }

  public function create($id_item)
  {
    // mandar una vista de formulario con el id_tarea
    $i = Inventario::find($id_item);
    // enviar además los jefes de departamento a los que enviar el mail
    $j = User::where('role', 2)->get();

    return view('problemaform', ['item'=>$i, 'jefes'=>$j]);
  }

  public function store(Request $request)
  {
    $problema = new Problema;
    $problema->comentario = $request->input('problema');
    $problema->id_item = $request->input('id');
    $problema->save();

    // una vez en la BD se debe avisar al jefe de dept.
    // declaración datos necesarios
    $mail_destino = $request->input('jefe');
    $mail_origen = 'jesus@iniciativasmultimedia.com';
    $item = Inventario::where('id', $request->input('id'))->select('equipo')->first();
    $mesg = 'Se ha encontrado un problema en las tareas de ' .
      $item['equipo'] .
      '. Un empleado reporta que: ' .
      $request->input('problema');// end mesg
    $headers = 'From: ' . $mail_origen . "\r\n" .
    'Reply-To: ' . $mail_origen . "\r\n" .
    'Content-Type: text/html; charset=UTF-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();// end headers

    mail($mail_destino, "Reporte de problema", $mesg, $headers);
    return redirect('home');
  }

  public function destroy($id)
  {
    Problema::destroy($id);
    return redirect('problemas/listado');
  }
}
