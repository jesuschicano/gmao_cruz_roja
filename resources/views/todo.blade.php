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
    <div class="panel panel-info">
      <div class="panel-heading">Información</div>
      <div class="panel-body">Marque las casillas de cada tarea realizada. Si encuentra algún problema, repórtelo con el botón inferior.</div>
    </div>

    <ul class="list-group">
      @foreach( $list as $x )
        <li class="list-group-item lead">
          <input type="checkbox" class="cajita"> {{$x->tarea}}
        </li>
      @endforeach
    </ul>

    <div class="row">
      <div class="col-sm-6 text-center">
        <button class="btn btn-success btn-lg">Confirmar</button>
      </div>
      <div class="col-sm-6 text-center">
        <a href="{{ url('tareas/problema/'.$id_item) }}" class="btn btn-danger btn-lg">Reportar problema</a>
      </div>
    </div>

    <!-- panel de error -->
    <div class="panel panel-danger collapse" id="error">
      <div class="panel-heading">Error</div>
      <div class="panel-body">No se han realizado todas las tareas. Si tiene algún problema, repórtelo desde el botón "Reportar problema".</div>
    </div>
    <!-- panel de exito -->
    <div class="panel panel-success collapse" id="exito">
      <div class="panel-heading">Tareas realizadas</div>
      <div class="panel-body">Se han realizado todas las tareas. Puede volver desde este <a href="{{url('tareas/'.Auth::user()->id)}}" class="link">enlace</a></div>
    </div>

	@endif
	</div>
  @push('funciones')
  <script type="text/javascript">
    $("document").ready(function(){
      var start = function(){
        // primero volver a ocultar mensajes si están abiertos
        $("#error").hide();
        $("#exito").hide();
        // comprobación si están todos o no marcados
        if( $('.cajita:checked').length != $('.cajita').length ){
          $("#error").show();
        }else{
          $("#exito").show();
        }//end if
      }//end start function

      $('.btn.btn-success').on("click", start);

    });
  </script>
  @endpush
@endsection
