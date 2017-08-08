@extends('layouts.app')

@section('content')
	<div class="container">
	@if (Auth::guest())
		<div class="col-xs-12 col-md-4 col-md-offset-4">
			<div class="panel panel-danger">
				<div class="panel-heading">Error</div>
				<div class="panel-body">No tienes permiso para estar aquí</div>
			</div>
		</div>

	@else
		<h1>Estas son las revisiones del artí­culo {{ $item->equipo }}</h1>
    @if ( !isset($revisiones) )
			<div class="alert alert-warning">
				<strong>Parece que no hay revisiones.</strong> Puedas agregar una nueva pulsando en el botón de añadir.
			</div>
			<a href="/revisiones/create/{{ $item->id }}" class="btn btn-primary btn-lg">Añadir</a>
		@else
			<table class="table">
				<thead>
					<th>#</th>
					<th>Descripción</th>
					<th>Grado</th>
					<th>Periodicidad</th>
					<th>Próxima revisión</th>
					<th>Acciones</th>
				</thead>
				@foreach($revisiones as $rev)
					<tr>
						<td>{{ $rev->id }}</td>
						<td>{{ $rev->descripcion }}</td>
						<td>{{ $rev->grado }}</td>
						<td>{{ $rev->period }} día(s)</td>
						<td>{{ $rev->prox_rev }}</td>
						<td>
							<a href="/revisiones/edit/{{ $rev->id }}" class="btn btn-warning">
								<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
							</a>
							<a href="/revisiones/destroy/{{ $rev->id }}" class="btn btn-danger" id="borraRev">
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</a>
						</td>
					</tr>
				@endforeach
			</table>
			<a href="/revisiones/create/{{ $item->id }}" class="btn btn-primary btn-lg">Añadir</a>
    @endif
	@endif
	</div>

@endsection
