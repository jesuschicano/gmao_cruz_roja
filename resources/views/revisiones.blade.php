@extends('layouts.app')

@section('content')
	<div class="container-fluid">
	@if (Auth::guest())
		<div class="col-xs-12 col-md-4 col-md-offset-4">
			<div class="panel panel-danger">
				<div class="panel-heading">Error</div>
				<div class="panel-body">No tienes permiso para estar aquí</div>
			</div>
		</div>

	@else
		<h1 class="text-center">Listado de revisiones</h1>
		<table class="table" id="misRevisiones">
			<thead>
				<th>Equipo</th>
        <th>Descripción</th>
        <th>Grado</th>
				<th>Departamento</th>
				<th>Última revisión</th>
        <th>Próxima revisión</th>
        <th>Aviso</th>
			</thead>
      @foreach($revisiones as $rev)
        <tr>
          <td>{{ $rev->equipo }}</td>
          <td>{{ $rev->descripcion }}</td>
          <td>{{ $rev->grado }}</td>
          <td>{{ $rev->dname }}</td>
          <td>{{ $rev->ultima_rev }}</td>
          <td>{{ $rev->prox_rev }}</td>
          <td>{{ $rev->aviso }}</td>
        </tr>
      @endforeach
		</table>
	@endif
	</div>
@endsection

@push('funciones')
  <script>
    $(document).ready(function(){
      $('#misRevisiones').DataTable({
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
