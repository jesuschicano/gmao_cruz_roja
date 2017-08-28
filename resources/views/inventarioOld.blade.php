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
		<h1>Consulta de artículos en helpdesk</h1>
		<table class="table" id="itemsHelpdesk">
			<thead>
				<th>#</th>
				<th>Código</th>
				<th>Equipo</th>
				<th>Marca</th>
				<th>Número serie</th>
				<th>Departamento responsable</th>
			</thead>
			@foreach($items as $x)
				<tr>
					<td>{{ $x->id }}</td><td>{{ $x->codigo }}</td><td>{{ $x->equipo }}</td><td>{{ $x->marca_fabricante }}</td><td>{{ $x->numero_serie }}</td><td>{{ $x->departamento_responsable }}</td>
				</tr>
			@endforeach
		</table>
	@endif
	</div>
@endsection

@push('funciones')
	<script>
    $(document).ready(function(){
      $('#itemsHelpdesk').DataTable({
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