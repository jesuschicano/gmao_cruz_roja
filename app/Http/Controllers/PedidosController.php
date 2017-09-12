<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Proveedor;

class PedidosController extends Controller
{
  public function generar(){
    $inventario = Inventario::all();
    $proveedor = Proveedor::all();
    return view('pedidos.generar', ['inventario'=>$inventario,'proveedores'=>$proveedor]);
  }
}
