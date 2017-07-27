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
		<h1>Estas son las periodicidades que hay configuradas</h1>
		<table class="table table-striped table-bordered">
		<thead>
			<th class="col-sm-1">#</th>
			<th class="col-sm-9">Periodos</th>
			<th class="col-sm-2">Acciones</th>
		</thead>
		@foreach ($datos as $x)
			<tr>
				<td>{{ $x->id }}</td>
				<td>{{ $x->periodicidad }}</td>
				<td>
					<a href="periodicidades/edit/{{ $x->id }}" class="btn btn-warning">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
					<a href="periodicidades/destroy/{{ $x->id }}" class="btn btn-danger" id="borraPeriod">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</td>
			</tr>
		@endforeach
		</table>
	@endif
	</div>
@endsection