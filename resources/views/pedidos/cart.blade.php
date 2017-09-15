@extends('layouts.app')

@section('content')
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">Resumen del pedido</div>
    <div class="panel-body">
      <ul>
        @foreach ($carrito as $item)
          <li>{{$item->quantity}} x <strong>{{$item->name}}</strong> - {{$item->price}} €/u</li>
        @endforeach
      </ul>
      <a href="{{action('CartController@destroy')}}" class="btn btn-danger">Descartar pedido</a>
    </div>
    <div class="panel-footer text-right">
      Total: {{ $total }}
    </div>
  </div>

  <?php
    $msg = "";
    foreach ($carrito as $y) {
      $cantidad = $y->quantity;
      $equipo = $y->name;
      $precio = $y->price;

      $msg = $msg.' '.$cantidad.' x '.$equipo.' - '.$precio.' €/u'. "<br>";
    }
    echo $msg;
  ?>
  <a href="{{url('carrito/enviar/jesus@kk/pijo')}}" class="btn btn-success">Enviar al proveedor</a>

</div>
@endsection
