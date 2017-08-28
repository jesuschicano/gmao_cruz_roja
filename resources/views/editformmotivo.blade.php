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
	      		<h2>Modificar motivo</h2>
	      	</div>

	          <div class="panel-body">
	            <form class="form-horizontal" method="POST" action="{{ action('MotivosController@update', $item->id) }}">
	            	{{ csrf_field() }}

	              <div class="form-group">
	                <label for="motivo" class="col-xs-12 col-md-2 control-label">Motivo</label>
	                <div class="col-xs-12 col-md-3">
										<input type="text" class="form-control" name="motivo" required autofocus value="{{ $item->motivo }}">
	                </div>
	              </div>
	              
                <button type="submit" class="btn btn-primary">Modificar</button>
	            </form>
	          </div><!--panel-body-->
	      </div><!--panel-->
	    </div><!--col-->
	  </div><!--row-->
	</div> <!-- container-->
@endif
@endsection