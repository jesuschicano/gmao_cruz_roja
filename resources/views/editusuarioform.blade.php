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
		<h2 class="text-center">Modificar el usuario {{$usuario->name}}</h2>
    <form action="{{ action('ControlUsuariosController@update', $usuario->id) }}" class="form-horizontal" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="usuario" class="col-sm-2 control-label">Usuario</label>
        <div class="col-sm-10">
          <input type="text" name="usuario" class="form-control" value="{{$usuario->name}}" required>
        </div>
      </div>
      <div class="form-group">
        <label for="mail" class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
          <input type="text" name="mail" class="col-sm-10 form-control" value="{{$usuario->email}}" required>
        </div>
      </div>
      <div class="form-group">
        <label for="pass" class="col-sm-2 control-label">Nueva contraseña (opcional)</label>
        <div class="col-sm-10">
          <input type="password" name="pass" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label for="role" class="col-sm-2 control-label">Tipo de usuario</label>
        <div class="col-sm-10">
          <select name="role" class="form-control" required>
            <option value="{{$usuario->role}}" selected>
              @if($usuario->role == 2)
              Jefe de departamento
              @elseif($usuario->role == 3)
              Empleado
              @endif
            </option>
            <option value="2">Jefe de departamento</option>
            <option value="3">Empleado</option>
          </select>
        </div>
      </div>
      <div class="form-group text-center">
        <input type="submit" class="btn btn-primary btn-lg" value="Modificar">
      </div>
    </form>
	@endif
	</div>

@endsection
