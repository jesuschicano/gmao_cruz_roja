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
	      <h3 class="text-center">Listado de ficheros</h3>
				@if( isset($msg) )
					<div class="alert alert-danger text-center">
						{{ $msg }}
					</div>
				@else
					<ul>
	          @foreach($archivos as $file)
	            <li>
	              <a class="btn btn-link" href="{{ action('ArchivosController@get', $file->filename) }}">
									{{ $file->original_filename }}
								</a>
	            </li>
	          @endforeach
	        </ul>
				@endif
	    </div><!--col-->
	  </div><!--row-->
	</div> <!-- container-->
@endif
@endsection
