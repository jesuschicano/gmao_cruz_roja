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
		<h2 class="text-center">Tus tareas asignadas</h2>

    <table class="table">
      <thead>
        <th class="col-sm-9">Equipo</th>
        <th class="col-sm-3">Acciones</th>
      </thead>
      @foreach( $tareas as $tarea )
        <tr>
          <td>{{$tarea->equipo}}</td>
          <td>
            <a href="{{ url('tareas/check/'.$tarea->id.'/'.Auth::user()->id) }}" class="btn btn-default">
              <span class="glyphicon glyphicon-list"></span>
            </a>
          </td>
        </tr>
      @endforeach
    </table>
	@endif
	</div>

@endsection
