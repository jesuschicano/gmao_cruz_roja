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
		<input type="text" id="filter" onkeyup="buscaEquipo()" placeholder="Búsqueda por equipo..." class="form-control">
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
						<a href="" class="btn btn-warning">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</a>
						<a href="inventario/destroy/{{ $x->id }}" class="btn btn-danger" id="borraItem">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
			@endforeach
		</table>
	@endif
	</div>
	<script type="text/javascript">
		function buscaEquipo()
		{
			var input, filter, table, tr, td, i;
			input = document.getElementById("filter");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("itemsGMAO");
		  tr = table.getElementsByTagName("tr");

		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[1];
		    if (td) {
		      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		        tr[i].style.display = "";
		      } else {
		        tr[i].style.display = "none";
		      }
		    }
		  }//for
		}//buscaEquipo()
	</script>
@endsection