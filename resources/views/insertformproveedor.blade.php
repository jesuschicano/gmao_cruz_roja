@extends('layouts.app')

@section('content')

@if (Auth::guest())
	<div class="col-xs-12 col-md-4 col-md-offset-4">
		<div class="panel panel-danger">
			<div class="panel-heading">Error</div>
			<div class="panel-body">No tienes permiso para estar aquí</div>
		</div>
	</div>
@else
	<div class="container">
	  <div class="row">
	    <div class="col-xs-12 col-md-10 col-md-offset-1">
	      <div class="panel panel-default">
	      	<div class="panel-heading text-center"><h2>Registro de un nuevo proveedor<h2></div>

	          <div class="panel-body">
	            <form class="form-horizontal" method="POST" action="{{ url('/proveedores/add') }}">
	            	{{ csrf_field() }}

	              <div class="form-group">
	                <label for="codigo" class="col-xs-12 col-md-2">Código</label>
	                <div class="col-xs-12 col-md-3">
										<input type="text" class="form-control" name="codigo" required autofocus>
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="nif" class="col-xs-12 col-md-2">NIF/DNI</label>
	              	<div class="col-xs-12 col-md-3">
										<input type="text" class="form-control" name="nif" required>
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="nombre" class="col-xs-12 col-md-2">Nombre</label>
	              	<div class="col-xs-12 col-md-6">
										<input type="text" class="form-control" name="nombre" required>
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="direccion" class="col-xs-12 col-md-2">Dirección</label>
	              	<div class="col-xs-12 col-md-9">
										<input type="text" class="form-control" name="direccion" required>
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="poblacion" class="col-xs-12 col-md-2">Población</label>
	              	<div class="col-xs-12 col-md-4">
										<input type="text" class="form-control" name="poblacion" required>
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="provincia" class="col-xs-12 col-md-2">Provincia</label>
	              	<div class="col-xs-12 col-md-4">
										<input type="text" class="form-control" name="provincia" required>
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="telefono" class="col-xs-12 col-md-2">Teléfono</label>
	              	<div class="col-xs-12 col-md-4">
										<input type="number" maxlength="9" class="form-control" name="telefono" required>
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="comercial" class="col-xs-12 col-md-2">Comercial</label>
	              	<div class="col-xs-12 col-md-6">
										<input type="text" class="form-control" name="comercial">
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="observaciones" class="col-xs-12 col-md-2">Observaciones</label>
	              	<div class="col-xs-12 col-md-6">
										<textarea class="form-control" name="observaciones" rows="3"></textarea>
	                </div>
	              </div>
                
                <button type="submit" class="btn btn-primary">Registrar</button>
	            </form>
	          </div><!--panel-body-->
	      </div><!--panel-->
	    </div><!--col-->
	  </div><!--row-->
	</div> <!-- container-->
@endif
@endsection