<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ControlUsuariosController extends Controller
{
  public function listAll(){
    // solo se van a listar los usuarios con un rol inferior
    // al de administrador
    $list = User::where('role', '!=', 1)->get();
    return view('listarUsuarios', ['usuarios' => $list]);
  }

  public function destroy($id){
    User::destroy($id);
    return redirect('usuarios/list');
  }

  public function modify($id){
    $usuario = User::find($id);
    return view('editusuarioform', ['usuario'=>$usuario]);
  }
  public function update($id, Request $request){
    $upd = User::find($id);
    $upd->name = $request->input('usuario');
    $upd->email = $request->input('mail');
    if($request->input('pass') != ""){
      $upd->password = bcrypt($request->input('pass'));
    }
    $upd->role = $request->input('role');
    $upd->save();
    return redirect('usuarios/list');
  }
}
