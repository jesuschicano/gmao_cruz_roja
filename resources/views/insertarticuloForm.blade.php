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
	      	<div class="panel-heading text-center"><h2>Registro de un nuevo artículo<h2></div>

	          <div class="panel-body">
	            <form class="form-horizontal" method="POST" action="{{ url('/inventario/store') }}">
	            	{{ csrf_field() }}

	              <div class="form-group">
	                <label for="codigo" class="col-xs-12 col-md-1 control-label">Código</label>
	                <div class="col-xs-12 col-md-3">
										<input type="text" class="form-control" name="codigo" required autofocus>
	                </div>
	              </div>

	              <div class="form-group">
	              	<label for="lugar" class="col-xs-12 col-md-1 control-label">Lugar</label>
	              	<div class="col-xs-12 col-md-5">
										<select name="lugar" class="form-control">
											<option disabled selected value> -- Seleccione una opción -- </option>
											@foreach($lugares as $lugar)
												<option value="{{ $lugar->id }}">{{ $lugar->name }}</option>
											@endforeach
										</select>
	                </div>
	              	<label for="departamento" class="col-xs-12 col-md-2 control-label">Departamento</label>
	              	<div class="col-xs-12 col-md-3">
										<select name="departamento" class="form-control">
											<option disabled selected value> -- Seleccione una opción -- </option>
											@foreach($departamentos as $departamento)
												<option value="{{ $departamento->department_id }}">{{ $departamento->dname }}</option>
											@endforeach
										</select>
	                </div>
	              </div>

	              <div class="form-group">
	              	<label for="equipo" class="col-xs-12 col-md-1 control-label">Equipo</label>
	              	<div class="col-xs-12 col-md-5">
	              		<input type="text" class="form-control" name="equipo">
	              	</div>
	              	<label for="marca" class="col-xs-12 col-md-1 control-label">Marca</label>
	              	<div class="col-xs-12 col-md-5">
										<input type="text" class="form-control" name="marca">
	                </div>
	              </div>

	               <div class="form-group">
	              	<label for="modelo" class="col-xs-12 col-md-1 control-label">Modelo</label>
	              	<div class="col-xs-12 col-md-6">
										<input type="text" class="form-control" name="modelo">
	                </div>
	              	<label for="serie" class="col-xs-12 col-md-2 control-label">N. serie</label>
	              	<div class="col-xs-12 col-md-3">
										<input type="text" class="form-control" name="serie">
	                </div>
	              </div>

	              <div class="form-group">
	              	<label for="proveedor" class="col-xs-12 col-md-1 control-label">Proveedor</label>
	              	<div class="col-xs-12 col-md-5">
										<select name="proveedor" class="form-control">
											<option disabled selected value> -- Seleccione una opción -- </option>
											@foreach($proveedores as $proveedor)
												<option value="{{ $proveedor->id }}">{{ $proveedor->codigo}} - {{ $proveedor->nombre }}</option>
											@endforeach
										</select>
	                </div>
	              </div>

	              <div class="form-group">
	              	<label for="fecha_compra" class="col-xs-12 col-md-2 control-label">Fecha compra</label>
	              	<div class="col-xs-12 col-md-4">
										<input type="text" name="fecha_compra" class="form-control picaFecha">
	                </div>
	              	<label for="observaciones" class="col-xs-12 col-md-2 control-label">Num. Factura</label>
	              	<div class="col-xs-12 col-md-4">
										<input type="text" name="num_factura" class="form-control">
	                </div>
									<label for="asiento" class="col-xs-12 col-md-2 control-label">Asiento contable</label>
									<div class="col-xs-12 col-md-4">
										<input type="text" class="form-control" name="asiento">
									</div>
									<label for="precio" class="col-xs-12 col-md-2 control-label">Precio con IVA</label>
									<div class="col-xs-12 col-md-4">
										<input type="text" class="form-control" name="precio">
									</div>
	              </div>

	              <div class="form-group">
	              	<label for="fecha_baja" class="col-xs-12 col-md-2 control-label">Fecha de baja</label>
									<div class="col-xs-12 col-md-4">
										<input type="text" class="form-control picaFecha" name="fecha_baja">
									</div>
									<label for="motivo" class="col-xs-12 col-md-2 control-label">Motivo</label>
									<div class="col-xs-12 col-md-4">
										<select name="motivo" class="form-control">
											<option disabled selected value> -- Seleccione una opción -- </option>
											@foreach($motivos as $motivo)
												<option value="{{ $motivo->id }}">{{ $motivo->motivo }}</option>
											@endforeach
										</select>
									</div>
	              </div>
									
	              <div class="form-group">
	              	<label for="tipo_mantenimiento" class="col-xs-12 col-md-3 control-label">Tipo de mantenimiento</label>
									<div class="col-xs-12 col-md-9">
										<select name="mantenimiento" class="form-control">
											<option value="correctivo">Correctivo</option>
											<option value="preventivo">Preventivo</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="periodicidad" class="col-xs-12 col-md-3 control-label">Periodicidad</label>
									<div class="col-xs-12 col-md-9">
										<select name="periodicidad" class="form-control">
											<option disabled selected value> -- Seleccione una opción -- </option>
											@foreach($periodicidades as $per)
												<option value="{{ $per->id }}">{{ $per->periodicidad }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="empresa_mantenimiento" class="col-xs-12 col-md-3 control-label">Empresa mantenimiento</label>
									<div class="col-xs-12 col-md-9">
										<select name="emp_mantenimiento" class="form-control">
											<option disabled selected value> -- Seleccione una opción -- </option>
											@foreach($proveedores as $proveedor)
												<option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
											@endforeach
										</select>
									</div>
	              </div>

	              <div class="form-group">
	              	<label for="file_contrato" class="col-xs-12 col-md-2 control-label">Adjuntar contrato</label>
									<div class="col-xs-12 col-md-10">
										<input type="file" name="file_contrato">
									</div>
	              </div>

	              <div class="form-group">
	              	<label for="importe_contrato" class="col-xs-12 col-md-2 control-label">Importe contrato</label>
									<div class="col-xs-12 col-md-2">
										<input type="text" name="importe_contrato" class="form-control">
									</div>
									<label for="inicio_contrato" class="col-xs-12 col-md-1 control-label">Incio contrato</label>
									<div class="col-xs-12 col-md-3">
										<input type="text" name="inicio_contrato" class="form-control picaFecha">
									</div>
									<label for="renovacion_contrato" class="col-xs-12 col-md-1 control-label">Renovación contrato</label>
									<div class="col-xs-12 col-md-3">
										<input type="text" name="renovacion_contrato" class="form-control picaFecha">
									</div>
	              </div>

								<div class="form-group">
	              	<label for="comentarios" class="col-xs-12 control-label">Comentarios</label>
									<div class="col-xs-12">
										<textarea name="comentarios" class="form-control" rows="7"></textarea>
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