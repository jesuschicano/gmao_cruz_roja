<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Inventario;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $inventario = Inventario::all();
      return view('pedidos.generar', ['inventario'=>$inventario]);
    }

    public function carrito(){
      $cartCollection = Cart::getContent();
      $subTotal = Cart::getSubTotal();
      return view('pedidos.cart', ['carrito' => $cartCollection, 'total' => $subTotal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
      Cart::clear();
      return redirect('carrito');
    }

    public function enviar($correo, $msg){
      return $correo." ".$msg;
    }
}
