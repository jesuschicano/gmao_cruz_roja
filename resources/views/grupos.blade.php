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
		<h2 class="text-center">Grupos de artículos</h2>
		<table class="table table-striped table-bordered">
		<thead>
			<th class="col-sm-9">Grupo</th>
      <th class="col-sm-3">Agregar/quitar elementos</th>
		</thead>
		@foreach ($grupos as $grupo)
			<tr>
				<td class="col-sm-9">{{ $grupo->equipo }}</td>
				<td class="col-sm-3">
					<a href="grupos/{{$grupo->id}}" class="btn btn-warning">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</a>
				</td>
			</tr>
		@endforeach
		</table>
	@endif
	</div>
@endsection
