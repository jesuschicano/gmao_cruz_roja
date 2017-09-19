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
		<h2 class="text-center">Listado de problemas reportados</h2>

    <table class="table">
      <thead>
        <th class="col-sm-1">#</th>
        <th class="col-sm-2">Equipo</th>
				<th class="col-sm-5">Problema</th>
				<th class="col-sm-2">Fecha</th>
				<th class="col-sm-2">Solucionado</th>
      </thead>
      @foreach( $problemas as $pro )
        <tr>
          <td>{{$pro->id}}</td>
					<td>{{$pro->equipo}}</td>
					<td>{{$pro->comentario}}</td>
					<td>{{$pro->created_at}}</td>
          <td>
            <a href="/problemas/listado/destroy/{{$pro->id}}" class="btn btn-success">
              <span class="glyphicon glyphicon-check"></span>
            </a>
          </td>
        </tr>
      @endforeach
    </table>
	@endif
	</div>

@endsection
