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
		<h2 class="text-center">Listado de tareas</h2>
    <!-- en el caso de no encontrar tuplas=>Ver mensaje -->
    @if( $errors->any() )
      <div class="panel panel-info">
        <div class="panel-heading">Información</div>
        <div class="panel-body">{{ $errors->first() }}</div>
      </div>
    @else
      <table class="table">
        <thead>
          <th class="col-sm-1">#</th>
          <th class="col-sm-7">Tarea</th>
          <th class="col-sm-2">Asignada</th>
          <th class="col-sm-2">Acciones</th>
        </thead>
        @foreach( $tareas as $tarea )
          <tr>
            <td>{{$tarea->id}}</td>
            <td>{{$tarea->tarea}}</td>
            <td>{{$tarea->name}}</td>
            <td>
              <a href="{{url('tareas/modify/'.$tarea->id)}}" class="btn btn-warning" title="Modificar">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
              </a>
              <a href="{{url('tareas/destroy/'.$tarea->id)}}" class="btn btn-danger" title="Borrar">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
              </a>
            </td>
          </tr>
        @endforeach
      </table>
    @endif

    <form action="{{ url('tareas/store') }}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="id_item" value="{{$id_item}}">
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
        <input type="text" class="form-control" name="tarea" required>
      </div>
      <div class="text-center">
        <input type="submit" class="btn btn-primary btn-lg" value="Guardar">
      </div>
    </form>
	@endif
	</div>

@endsection
