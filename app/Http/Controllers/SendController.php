<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;

class SendController extends Controller
{
  public function mandarAviso()
  {
    $link = DB::connection('mysql2')->getDatabaseName();

    // se necesita la fecha actual
    $hoy = date('Y-m-d');

    $revisiones = DB::table('revisiones')
      ->join('inventario', 'inventario.id', '=', 'revisiones.id_item')
      ->join(
        new Expression($link.'.jos_huruhelpdesk_places'),
        'inventario.id_lugar',
        '=',
        new Expression($link.'.jos_huruhelpdesk_places.id')
      )
      ->where([
      ['aviso', '>=', $hoy],
      ['prox_rev', '>', $hoy]
      ])
      ->select('inventario.equipo',
      new Expression($link.'.jos_huruhelpdesk_places.name'),
      'descripcion',
      'prox_rev',
      'correo')->get();

    return view('emails.correo_aviso', ['revisiones' => $revisiones]);

  }

}
