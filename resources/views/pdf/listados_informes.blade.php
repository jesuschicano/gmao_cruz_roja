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
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
          <h1 class="text-center">Directorio de informes</h1>
            <ul>
              <li>
                Listado de las revisiones hasta la fecha actual
                <a href="{{ action('PDFController@crearInformeTodasRevisiones') }}" class="btn btn-info pull-right">Descargar</a>
              </li>
            </ul>
        </div>
      </div>
    </div>
	@endif
@endsection
