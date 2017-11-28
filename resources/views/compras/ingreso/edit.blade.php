@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente: {{$persona->nombre}}</h3>
			@if (count($errors)>0)
				<div class="alert alert-danger">
					<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
					</ul>
				</div>
			@endif
		</div>
	</div>
			{!!Form::model($persona,['method'=>'PATCH','route'=>['compras.proveedor.update', $persona->idpersona]])!!}
			{{Form::token()}}

		<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" name="nombre" class="form-control"  required value="{{$persona->nombre}}" placeholder="Descripcion...">	
					</div>
				</div>	
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="direccion">Direccion</label>
						<input type="text" name="direccion" class="form-control"  required  value="{{$persona->direccion}}" placeholder="Direccion...">	
					</div>
				</div>	
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="tipo_documento">Documento</label>
						<select name="tipo_documento" class="form-control">
							@if ($persona->tipo_documento=='CI')
								<option selected value="CI">Cedula</option>
								<option value="RUC">RUC</option>
								<option value="PAS">Pasaporte</option>
							@elseif ($persona->tipo_documento=='RUC')
								<option  value="CI">Cedula</option>
								<option selected value="RUC">RUC</option>
								<option value="PAS">Pasaporte</option>
							@else
								<option  value="CI">Cedula</option>
								<option  value="RUC">RUC</option>
								<option selected value="PAS">Pasaporte</option>
							@endif


						</select>	
					</div>
						
				</div>
				
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="num_documento">No. Documento</label>
						<input type="text" name="num_documento" class="form-control"  value="{{$persona->num_documento}}" placeholder="No.Documento...">	
					</div>
				</div>	
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="telefono">Telefono</label>
						<input type="text" name="telefono" class="form-control"  value ="{{$persona->telefono}}" placeholder="Telefono ...">	
					</div>
				</div>	
					
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" class="form-control" value="{{$persona->email}}">	
					</div>
				</div>	

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
					<div class="form-group">
						<button class="btn btn-danger" type="reset">Cancelar</button>
						<button class="btn btn-primary" type="submit">Guardar</button>
					</div>
				</div>
			</div>


		{!!Form::close()!!}
		

@endsection

