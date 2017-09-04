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
		<h1 class="text-center">Listado de proveedores</h1>
		<table class="table table-striped table-bordered" id="listaProveedores">
		<thead>
			<th>Código</th><th>DNI/CIF</th><th>Nombre</th><th>Dirección</th><th>Población</th><th>Provincia</th><th>Teléfono</th><th>Comercial</th><th>Acciones</th>
		</thead>
		@foreach ($proveedores as $x)
			<tr>
				<td>{{ $x->codigo }}</td>
				<td>{{ $x->nif }}</td>
				<td>{{ $x->nombre }}</td>
				<td>{{ $x->direccion }}</td>
				<td>{{ $x->poblacion }}</td>
				<td>{{ $x->provincia }}</td>
				<td>{{ $x->telefono }}</td>
				<td>{{ $x->comercial }}</td>
				<td>
					<a href="proveedores/editar/{{ $x->id }}" class="btn btn-warning">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
					<a href="proveedores/borrar/{{ $x->id }}" class="btn btn-danger" id="borraProv">
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
      $('#listaProveedores').DataTable({
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
