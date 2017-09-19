<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Proveedor;
use App\Inventario;

class CartController extends Controller
{
    public function index()
    {
      $inventario = Inventario::all();
      return view('pedidos.generar', ['inventario'=>$inventario]);
    }

    public function carrito(){
      $cartCollection = Cart::getContent();
      $subTotal = Cart::getSubTotal();
      $proveedores = Proveedor::all();
      return view('pedidos.cart', ['carrito' => $cartCollection, 'total' => $subTotal, 'proveedores'=>$proveedores]);
    }

    public function store(Request $request)
    {
      Cart::add(array(
        'id' => $request->input('id'),
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'quantity' => $request->input('quantity'),
        'attributes' => array()
      ));
      return redirect('pedido');
    }

    public function destroy()
    {
      Cart::clear();
      return redirect('carrito');
    }

    public function enviar(Request $request){
      $mail_destino = $request->input('proveedor');
      $mail_origen = 'jesus@iniciativasmultimedia.com';
      $msg = $request->input('msg');
      $headers = 'From: ' . $mail_origen . "\r\n" .
      'Reply-To: ' . $mail_origen . "\r\n" .
      'Content-Type: text/html; charset=UTF-8' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();// end headers
      mail($mail_destino, "Pedido a proveedor", $msg, $headers);
      return redirect('carrito');
    }
}
