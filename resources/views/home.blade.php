@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="jumbotron">
			<h1 class="text-center">GMAO</h1>
			<img src="{{URL::asset('/img/cruz-233x200.jpg')}}" alt="imagen hospital cabecera" class="img-responsive center-block">
			<div class="alert alert-default text-center">
				<h3>Bienvenido al gestor de revisiones para el Hospital Cruz Roja de Córdoba.</h3>
			</div>
		</div>
	</div>
@endsection
