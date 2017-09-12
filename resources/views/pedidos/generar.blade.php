@extends('layouts.app')

@section('content')
<?php
if( empty($_SESSION['cart']) ){
  $_SESSION['cart'] = array();
}
?>
<div class="container">
  <h3 class="text-center">Generar un pedido</h3>
  <!-- formulario con proveedores y articulos -->
  <form action="" class="form-inline">
    <div class="form-group">
      <label for="proveedor" class="form-label">Escoja el proveedor al que realizar el pedido</label>
      <select name="proveedor" class="form-control">
        @foreach($proveedores as $x)
          <option value="{{ $x->mail }}">{{ $x->nombre }}</option>
        @endforeach
      </select>
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
          <td class="col-md-9"><input type="text" name="equipo" value="{{ $y->equipo }}" disabled></td>
          <td class="col-md-1"><input type="text" name="cantidad" class="form-control"></td>
          <td class="col-md-1"><input type="text" name="precio" class="form-control"></td>
					<td class="col-md-1">
						<button class="btn btn-info" value="{{ $y->codigo }}">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
					</td>
				</tr>
			@endforeach
		</table>
  </form><!-- end form -->

  <!-- listado -->
  <ul id="listItems">

  </ul>
</div>
@endsection
@push('funciones')
<script>
  $(document).ready(function(){

  });
</script>
@endpush
