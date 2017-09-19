@extends('layouts.app')

@section('content')
	<div class="container">
	@if (Auth::guest() OR Auth::user()->role != 1)
		<div class="col-xs-12 col-md-4 col-md-offset-4">
			<div class="panel panel-danger">
				<div class="panel-heading">Error</div>
				<div class="panel-body">No tienes permiso para estar aquí</div>
			</div>
		</div>
	@else
		<h2>Listado de usuarios</h2>
		<table class="table">
			<thead>
				<th>#</th>
				<th>Usuario</th>
				<th>Mail</th>
				<th>Rol</th>
				<th>Acciones</th>
			</thead>
			<tbody>
				@foreach( $usuarios as $user )
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>
							@if( $user->role == 2 )
								Jefe de departamento
							@elseif( $user->role == 3 )
								Empleado
							@endif
						</td>
						<td>
							<a href="/usuarios/modify/{{$user->id}}" class="btn btn-warning" title="Modificar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
							<a href="/usuarios/destroy/{{$user->id}}" class="btn btn-danger" title="Borrar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
	</div>

@endsection
