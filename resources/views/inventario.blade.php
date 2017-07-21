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
		<h1>Estos son los departamentos</h1>
		@foreach($departamentos as $x)
			{{ $x->equipo }}<br>
		@endforeach
	@endif
	</div>
@endsection