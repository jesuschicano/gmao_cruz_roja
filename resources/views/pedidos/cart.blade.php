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
    $msg = null;
    foreach ($carrito as $y) {
      $cantidad = $y->quantity;
      $equipo = $y->name;
      $precio = $y->price;

      $msg = $msg.' '.$cantidad.' x '.$equipo.' - '.$precio.' €/u'. "\r\n";
    }
  ?>

  <form action="carrito/enviar" method="post">
    {{csrf_field()}}
    <textarea name="msg" class="hidden">
      {{$msg}}
    </textarea>
    <div class="form-group">
      <label for="" class="control-label">Escoja un proveedor al que realizar el pedido</label>
      <select class="form-control" name="proveedor">
        @foreach($proveedores as $proveedor)
          <option value="{{$proveedor->mail}}">[{{$proveedor->codigo}}]{{$proveedor->nombre}}</option>
        @endforeach
      </select>
    </div>
    <input type="submit" value="Enviar" class="btn btn-success">
  </form>

</div>
@endsection
