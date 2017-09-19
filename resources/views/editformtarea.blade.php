@extends('layouts.app')

@section('content')
	<div class="container">
	@if (Auth::guest() OR Auth::user()->role == 3)
		<div class="col-xs-12 col-md-4 col-md-offset-4">
			<div class="panel panel-danger">
				<div class="panel-heading">Error</div>
				<div class="panel-body">No tienes permiso para estar aquí</div>
			</div>
		</div>
	@else
		<h2 class="text-center">Editar tarea</h2>

    <form action="{{ url('tareas/update') }}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$tarea->id}}">
      <div class="form-group">
        <label for="usuario" class="control-label">Escoja un usuario al que asignar la tarea</label>
        <select name="usuario" class="form-control">
          @foreach( $empleados as $empleado)
            <option value="{{$empleado->id}}">{{$empleado->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="tarea" class="control-label">Describa la tarea</label>
        <input type="text" class="form-control" name="tarea" value="{{$tarea->tarea}}" required>
      </div>
      <div class="text-center">
        <input type="submit" class="btn btn-primary btn-lg" value="Actualizar">
      </div>
    </form>
	@endif
	</div>

@endsection
