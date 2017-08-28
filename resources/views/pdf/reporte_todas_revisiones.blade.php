<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Styles -->
 	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 	<style>
 		body { font-family: DejaVu Sans; }
 	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h3 class="text-center">Revisiones hasta @php echo date('d-m-Y'); @endphp</h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Equipo</th>
		        <th>Descripción</th>
		        <th>Grado</th>
						<th>Departamento</th>
						<th>Última revisión</th>
	        </tr>
				</thead>
				<tbody>
	      @foreach($data as $rev)
	        <tr>
	          <td>{{ $rev->equipo }}</td>
	          <td>{{ $rev->descripcion }}</td>
	          <td>{{ $rev->grado }}</td>
	          <td>{{ $rev->dname }}</td>
	          <td>{{ $rev->ultima_rev }}</td>
	        </tr>
	      @endforeach
	      </tbody>
			</table>
		</div>
	</div>
	</body>
</html>