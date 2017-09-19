@extends('layouts.app')

@section('content')
	<div class="container">
	@if (Auth::guest() OR Auth::user()->role != 3)
		<div class="col-xs-12 col-md-4 col-md-offset-4">
			<div class="panel panel-danger">
				<div class="panel-heading">Error</div>
				<div class="panel-body">No tienes permiso para estar aquí</div>
			</div>
		</div>
	@else
		<h2 class="text-center">Reporte de un problema en {{$item->equipo}}</h2>

    <form action="{{ action('ProblemasController@store') }}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$item->id}}">
      <div class="form-group">
        <label for="jefe" class="control-label">Escoja un jefe de departamento al que enviar el informe</label>
        <select name="jefe" class="form-control">
          @foreach( $jefes as $jefe)
            <option value="{{$jefe->email}}">{{$jefe->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="problema" class="control-label">Describa el problema</label>
        <input type="text" class="form-control" name="problema" required>
      </div>
      <div class="text-center">
        <input type="submit" class="btn btn-primary btn-lg" value="Enviar">
      </div>
    </form>
	@endif
	</div>

@endsection
