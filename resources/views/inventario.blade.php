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
		<h1>Consulta de artículos de GMAO</h1>
		<table class="table" id="itemsGMAO">
			<thead>
				<th>Código</th>
				<th>Equipo</th>
				<th>Lugar</th>
				<th>Departamento</th>
				<th>Acciones</th>
			</thead>
			@foreach($datos as $x)
				<tr>
					<td>{{ $x->codigo }}</td>
					<td>{{ $x->equipo }}</td>
					<td>{{ $x->name }}</td>
					<td>{{ $x->dname }}</td>
					<td>
						<a href="inventario/edit/{{ $x->id }}" class="btn btn-warning" title="Modificar">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</a>
						<a href="revisiones/{{ $x->id }}" class="btn btn-default" title="Revisiones">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
						</a>
						<a href="inventario/destroy/{{ $x->id }}" class="btn btn-danger" title="Borrar" id="borraItem">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
			@endforeach
		</table>
	@endif
	</div>
@endsection

@push('funciones')
	<script>
    $(document).ready(function(){
      $('#itemsGMAO').DataTable({
        "language": {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        }
      });
    });
  </script>
@endpush
