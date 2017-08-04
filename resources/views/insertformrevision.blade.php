@extends('layouts.app')

@section('content')

@if (Auth::guest())
	<div class="col-xs-12 col-md-4 col-md-offset-4">
		<div class="panel panel-danger">
			<div class="panel-heading">Error</div>
			<div class="panel-body">No tienes permiso para estar aquí</div>
		</div>
	</div>
@else
	<div class="container">
	  <div class="row">
	    <div class="col-xs-12 col-md-10 col-md-offset-1">
	      <div class="panel panel-default">
	      	<div class="panel-heading text-center">
	      		<h2>Registro de una nueva revisión para {{ $datos->equipo }}</h2>
	      	</div>

	          <div class="panel-body">
	            <form class="form-horizontal container-fluid" method="POST" action="/revisiones/save/{{ $datos->id }}">
	            	{{ csrf_field() }}

								<div class="form-group">
									<label for="descripcion">Una breve descripción</label>
									<input type="text" name="descripcion" class="form-control" required autofocus>
								</div>

	              <div class="form-group">
	                <label for="periodo">Periodicidad en días</label>
                  <select name="periodo" id="period" class="form-control" required>
										@foreach($periodos as $per)
                    	<option value="{{ $per->periodicidad }}">{{ $per->periodicidad }}</option>
										@endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="grado">Grado</label>
                  <select name="grado" class="form-control">
                    <option value="1">Primer grado</option>
                    <option value="2">Segundo grado</option>
                    <option value="3">Tercer grado</option>
                    <option value="4">Cuarto grado</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="dep">Departamento encargado</label>
                  <select name="dep" id="" class="form-control">
										@foreach($depart as $dep)
                    	<option value="{{ $dep->department_id }}">{{ $dep->dname }}</option>
										@endforeach
                  </select>
                </div>

                <div class="form-group alert alert-info">
									<label for="rev_actual">Fecha de última revisión realizada</label>
                  <input type="text" id="rev_actual" name="rev_actual" class="form-control picaFecha" required>
                </div>
                <div class="form-group alert alert-info">
									<label for="prox_rev">Fecha de la próxima revisión</label>
                  <input type="text" id="prox_rev" name="prox_rev" class="form-control picaFecha" required>
                </div>
                <div class="form-group alert alert-warning">
									<label for="aviso_rev">Fecha de aviso hasta la próxima revisión</label>
                  <input type="text" id="aviso_rev" name="aviso_rev" class="form-control picaFecha" required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
	            </form>

							@if(session()->has('msg'))
								<div class="alert alert-danger">La <b>fecha de aviso</b> debe ser anterior a la próxima revisión</div>
							@endif

	          </div><!--panel-body-->
	      </div><!--panel-->
	    </div><!--col-->
	  </div><!--row-->
	</div> <!-- container-->
@endif
@endsection

@push('funciones')
  <script>
  /*recoger los campos*/
  var prox = $("#prox_rev");
  var actual = $("#rev_actual");

  actual.change(function(){
		//los días los meto aquí para que siempre vuelva a lee
		var dias = $("#period").val();
    //transformar en fecha la revision actual
    var result = new Date( actual.val() );
    //incrementarle la cantidad de días escogidos en periodicidad
    result.setDate(result.getDate() + parseInt(dias));
    //poner la nueva fecha en un nuevo string
    prox.val(result.getFullYear() + '-' + ("0"+(result.getMonth()+1)).slice(-2) + '-' + ("0"+result.getDate()).slice(-2) );
  });


  </script>
@endpush
