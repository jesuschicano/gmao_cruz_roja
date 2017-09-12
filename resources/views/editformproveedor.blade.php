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
	      	<div class="panel-heading text-center">
	      		<h2>Modificar proveedor</h2>
	      	</div>

	          <div class="panel-body">
	            <form class="form-horizontal" method="POST" action="{{ action('ProveedoresController@editar', $item->id) }}">
	            	{{ csrf_field() }}

	              <div class="form-group">
	                <label for="codigo" class="col-xs-12 col-md-2">Código</label>
	                <div class="col-xs-12 col-md-3">
										<input type="text" class="form-control" name="codigo" required autofocus value="{{ $item->codigo }}">
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="nif" class="col-xs-12 col-md-2">NIF/DNI</label>
	              	<div class="col-xs-12 col-md-3">
										<input type="text" class="form-control" name="nif" required value="{{ $item->nif }}">
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="nombre" class="col-xs-12 col-md-2">Nombre</label>
	              	<div class="col-xs-12 col-md-6">
										<input type="text" class="form-control" name="nombre" required value="{{ $item->nombre }}">
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="direccion" class="col-xs-12 col-md-2">Dirección</label>
	              	<div class="col-xs-12 col-md-9">
										<input type="text" class="form-control" name="direccion" required value="{{ $item->direccion }}">
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="poblacion" class="col-xs-12 col-md-2">Población</label>
	              	<div class="col-xs-12 col-md-4">
										<input type="text" class="form-control" name="poblacion" required value="{{ $item->poblacion }}">
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="provincia" class="col-xs-12 col-md-2">Provincia</label>
	              	<div class="col-xs-12 col-md-4">
										<input type="text" class="form-control" name="provincia" required value="{{ $item->provincia }}">
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="telefono" class="col-xs-12 col-md-2">Teléfono</label>
	              	<div class="col-xs-12 col-md-4">
										<input type="number" maxlength="9" class="form-control" name="telefono" required value="{{ $item->telefono }}">
	                </div>
	              </div>
								<div class="form-group">
	              	<label for="mail" class="col-xs-12 col-md-2">E-mail</label>
	              	<div class="col-xs-12 col-md-4">
										<input type="text" class="form-control" name="mail" value="{{ $item->mail }}" required>
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="comercial" class="col-xs-12 col-md-2">Comercial</label>
	              	<div class="col-xs-12 col-md-6">
										<input type="text" class="form-control" name="comercial" value="{{ $item->comercial }}">
	                </div>
	              </div>
	              <div class="form-group">
	              	<label for="observaciones" class="col-xs-12 col-md-2">Observaciones</label>
	              	<div class="col-xs-12 col-md-6">
										<textarea class="form-control" name="observaciones" rows="3">
											{{ $item->observaciones }}
										</textarea>
	                </div>
	              </div>

                <button type="submit" class="btn btn-primary">Modificar</button>
	            </form>
	          </div><!--panel-body-->
	      </div><!--panel-->
	    </div><!--col-->
	  </div><!--row-->
	</div> <!-- container-->
@endif
@endsection
