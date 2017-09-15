@extends('layouts.app')

@section('content')
<?php
/*if( empty($_SESSION['cart']) ){
  $_SESSION['cart'] = array();
}*/
?>
@if (Auth::guest())
	<div class="col-xs-12 col-md-4 col-md-offset-4">
		<div class="panel panel-danger">
			<div class="panel-heading">Error</div>
			<div class="panel-body">No tienes permiso para estar aquí</div>
		</div>
	</div>
@else
<div class="container">
  <h3 class="text-center">Generar un pedido</h3>
  <div class="alert alert-info text-center">
    Especifique <strong>una cantidad</strong> más <strong>un precio</strong>, después pulse en el botón
    <strong>añadir</strong> de cada artículo. El listado del pedido se irá generando <strong>automáticamente</strong>.
     Cuando haya terminado, pulse el botón <strong>confirmar</strong>.
     Esto lo llevará a la confirmación del pedido donde puede especificar el proveedor.
     NOTA: Los <strong>precios con decimales</strong> se escriben con un punto "."
  </div>
  <table class="table" id="xxxxxxxxxxx">
		<thead>
			<th>Equipo</th>
      <th>Cantidad</th>
      <th>Precio</th>
			<th>Añadir</th>
		</thead>
		@foreach($inventario as $y)
			<tr>
        <form action="{{ action('CartController@store') }}" method="post">
          {{ csrf_field() }}
          <td class="col-md-9"><input type="text" name="name" value="{{ $y->equipo }}" class="form-control"></td>
          <td class="col-md-1"><input type="text" name="quantity" class="form-control"></td>
          <td class="col-md-1"><input type="text" name="price" class="form-control"></td>
  				<td class="col-md-1">
            <input type="hidden" name="id" value="{{ $y->codigo }}">
  					<button type="submit" class="btn btn-info">
  						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
  					</button>
  				</td>
        </form>
			</tr>
		@endforeach
	</table>
  <a href="{{url('carrito')}}" class="btn btn-lg btn-info">Confirmar</a>
</div>
@endif

@endsection




@push('funciones')
<script>
  $(document).ready(function(){

  });
</script>
@endpush
