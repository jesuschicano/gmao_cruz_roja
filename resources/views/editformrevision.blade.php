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
	      		<h2>Editar revisión para {{ $item->equipo }}</h2>
	      	</div>

	          <div class="panel-body">
              @if(session()->has('msg'))
               <div class="alert alert-danger">La <b>fecha de aviso</b> debe ser anterior a la próxima revisión</div>
              @endif
	            <form class="form-horizontal container-fluid" method="POST" action="{{ action('RevisionController@update', $revision->id) }}">
	            	{{ csrf_field() }}

								<input type="hidden" value="{{ $item->id }}" name="id_item">

								<div class="form-group">
									<label for="descripcion">Una breve descripción</label>
									<input type="text" name="descripcion" class="form-control" required autofocus value="{{ $revision->descripcion }}">
								</div>

	              <div class="form-group">
	                <label for="periodo">Periodicidad en días</label>
                  <select name="periodo" id="period" class="form-control" required>
                    <option selected value="{{ $revision->period }}">{{ $revision->period }}</option>
                    @foreach($periodos as $per)
                    	<option value="{{ $per->periodicidad }}">{{ $per->periodicidad }}</option>
										@endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="grado">Grado</label>
                  <select name="grado" class="form-control">
										<option selected value="{{ $revision->grado }}">
											@if($revision->grado == 1)
												Primer grado
											@elseif($revision->grado == 2)
												Segundo grado
											@elseif($revision->grado == 3)
												Tercer grado
											@else
												Cuarto grado
											@endif
										</option>
                    <option value="1">Primer grado</option>
                    <option value="2">Segundo grado</option>
                    <option value="3">Tercer grado</option>
                    <option value="4">Cuarto grado</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="dep">Departamento encargado</label>
                  <select name="dep" id="" class="form-control">
                    <option selected value="{{ $revision->id_depart }}">{{ $rev_dep->dname }}</option>
										@foreach($depart as $dep)
                    	<option value="{{ $dep->department_id }}">{{ $dep->dname }}</option>
										@endforeach
                  </select>
                </div>

								<div class="form-group">
									<label for="correo">E-mail que recibirá el aviso</label>
									<input type="text" name="correo" class="form-control" value="{{ $revision->correo }}" required>
								</div>

                <div class="form-group alert alert-info">
                  <label for="">Fecha de última revisión realizada</label>
                  <input type="text" id="rev_actual" name="rev_actual" class="form-control picaFecha" placeholder="Fecha de última revisión realizada" required value="{{ $revision->ultima_rev }}">
                </div>
                <div class="form-group alert alert-info">
                  <label for="">Fecha de la próxima revisión</label>
                  <input type="text" id="prox_rev" name="prox_rev" class="form-control picaFecha" placeholder="Fecha de la próxima revisión" required value="{{ $revision->prox_rev }}">
                </div>
                <div class="form-group alert alert-warning">
                  <label for="">Fecha de aviso hasta la próxima revisión</label>
                  <input type="text" id="aviso_rev" name="aviso_rev" class="form-control picaFecha" placeholder="Fecha de aviso hasta la próxima revisión" required value="{{ $revision->aviso }}">
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
	            </form>
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
