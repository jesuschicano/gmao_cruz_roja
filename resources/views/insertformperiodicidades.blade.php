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
	      		<h2>Registro de una nueva periodicidad</h2>
	      	</div>

	          <div class="panel-body">
	            <form class="form-horizontal" method="POST" action="/periodicidades/store">
	            	{{ csrf_field() }}

	              <div class="form-group">
	                <label for="period" class="col-xs-12 col-md-3 control-label">Introduce un número de días</label>
	                <div class="col-xs-12 col-md-9">
										<div class="input-group">
											<input type="number" class="form-control" name="period" required autofocus>
											<div class="input-group-addon">días</div>
										</div>
	                </div>
	              </div>

                <button type="submit" class="btn btn-primary">Registrar</button>
	            </form>
	          </div><!--panel-body-->
	      </div><!--panel-->
	    </div><!--col-->
	  </div><!--row-->
	</div> <!-- container-->
@endif
@endsection
