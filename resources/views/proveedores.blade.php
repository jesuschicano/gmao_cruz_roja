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
		<h1>Estos son los proveedores</h1>
		<table class="table table-striped table-bordered">
		<thead>
			<th>Código</th><th>DNI/CIF</th><th>Nombre</th><th>Dirección</th><th>Población</th><th>Provincia</th><th>Teléfono</th><th>Comercial</th><th>Acciones</th>
		</thead>
		@foreach ($proveedores as $x)
			<tr>
				<td>{{ $x->codigo }}</td>
				<td>{{ $x->dni }}</td>
				<td>{{ $x->nombre }}</td>
				<td>{{ $x->direccion }}</td>
				<td>{{ $x->poblacion }}</td>
				<td>{{ $x->provincia }}</td>
				<td>{{ $x->telefono }}</td>
				<td>{{ $x->comercial }}</td>
			</tr>
		@endforeach
		</table>
	@endif

@endsection