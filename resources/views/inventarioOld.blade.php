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
		<input type="text" id="filter" onkeyup="buscaEquipo()" placeholder="Búsqueda por equipo..." class="form-control">
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
	<script type="text/javascript">
		function buscaEquipo()
		{
			var input, filter, table, tr, td, i;
			input = document.getElementById("filter");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("itemsHelpdesk");
		  tr = table.getElementsByTagName("tr");

		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[2];
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