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
    <h2 class="text-center">Componentes del grupo</h2>
    <?php
      // registro del padre al que se va a registrar
      global $padre_global;
      $padre_global = $padre;
    ?>
    <!-- ***************************************************** -->
    <!-- primero se comprueba que tiene elementos -->
    @if( !$list1->isEmpty() )
		  <table class="table table-striped table-bordered">
  		  <thead>
    			<th class="col-sm-3">Código</th>
          <th class="col-sm-7">Equipo</th>
          <th class="col-sm-2">Eliminar</th>
    		</thead>
		  @foreach ($list1 as $item1)
  			<tr>
  				<td>{{ $item1->codigo }}</td>
  				<td>{{ $item1->equipo }}</td>
          <td>
            <a href="{{url('grupos/remove/' . $padre_global .'/'. $item1->id)}}" class="btn btn-danger">
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </a>
          </td>
  			</tr>
  		@endforeach
		  </table>
    @else
      <!-- sino tiene elementos asignados, muestra cartel -->
      <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="panel panel-info">
          <div class="panel-heading">No hay elementos en este grupo</div>
          <div class="panel-body">Puede agregar elementos de la lista de abajo.</div>
        </div>
      </div>
    @endif
    <!-- ********************************************** -->
    <!-- tabla para agregar elementos -->
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center text-info lead">Escoja de este listado el artículo a insertar</div>
      </div>
    </div>
    <table class="table table-striped table-bordered">
      <thead>
        <th class="col-sm-3">Código</th>
        <th class="col-sm-7">Equipo</th>
        <th class="col-sm-2">Agregar</th>
      </thead>
      @foreach( $list2 as $item2 )
        <tr>
          <td>{{$item2->codigo}}</td>
          <td>{{$item2->equipo}}</td>
          <td>
            <a href="{{url('grupos/add/' . $padre_global .'/'. $item2->id)}}" class="btn btn-primary">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
          </td>
        </tr>
      @endforeach
    </table>

  @endif
	</div>
@endsection
