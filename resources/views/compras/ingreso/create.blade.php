@extends('layouts.admin')
@section('contenido')
	<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<h3>Nuevo Ingreso</h3>
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
			{!!Form::open(array('url'=>'compras/ingreso', 'method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}

	<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group">
					<label for="proveedor">Proveedor</label>
					<select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true">
						@foreach($personas as $persona)
						<option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
						@endforeach
						
					</select>
				</div>
			</div>	
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label>Comprobante</label>
					<select name="tipo_comprobante" class="form-control">
						<option value="Boleta">Boleta</option>
						<option value="Factura">Factura</option>
						<option value="Ticket">Tickets</option>
					</select>
				</div>
			</div>	
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label for="serie_comprobante">Serie Comprobante</label>
					<input type="text" name="serie_comprobante" value="{{old('serie_comprobante')}}" placeholder="Serie de comprobante..." class="form-control">	
				</div>
					
			</div>

			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label for="num_comprobante">Numero Comprobante</label>
					<input type="text" name="num_comprobante" required value="{{old('num_comprobante')}}" placeholder="Serie de comprobante..." class="form-control">	
				</div>
					
			</div>
	</div>	
			
	<div class="row">

			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
						<label>Articulo</label>
						<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
							@foreach($articulos as $articulo)
							<option value="{{$articulo->idarticulo}}">{{$articulo->articulo}}</option>
							@endforeach
						</select>
					</div>

					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
						<div class="form-group">
							<label for="cantidad">Cantidad</label>
							<input type="number" name="pcantidad" id="pcantidad" placeholder="Cantidad..." class="form-control">	
						</div>						
					</div>
					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
						<div class="form-group">
							<label for="precio_compra">Precio Compra</label>
							<input type="number" name="pprecio_compra" id="pprecio_compra" placeholder="precio de compra..." class="form-control">	
						</div>						
					</div>
					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
						<div class="form-group">
							<label for="precio_venta">Precio venta</label>
							<input type="number" name="pprecio_venta" id="pprecio_venta" placeholder="precio de venta..." class="form-control">	
						</div>						
					</div>
					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
						<div class="form-group">
							<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
						</div>						
					</div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">	
						<table  id="detalles" class="table table-striped table-bordered table-condesed table-hover">
							<thead style="background:#A9D0F5">
								<th>Opciones</th>
								<th>Articulo</th>
								<th>Cantidad</th>
								<th>Precio Compra</th>
								<th>Precio Venta</th>
								<th>Subtotal</th>
							</thead>								

							<tfoot>
								<th>Total</th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th><h4 id="total">C$/.0.00</h4></th>
							</tfoot>

							<tbody>
								
							</tbody>
						
						</table>
					</div>
				</div>	
			</div>

			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
				<div class="form-group">
					<input  name"_token" value="{{ csrf_token() }}" type="hidden">
					<button class="btn btn-danger" type="reset">Cancelar</button>
					<button class="btn btn-primary" type="submit">Guardar</button>
				</div>
			</div>
	</div>
	
{!!Form::close()!!}
		
@push('scripts')
<script>

	$(document).ready(function(){
		$('#bt_add').click(function(){
			agregar();
		});
	});

	total=0;
	var contador=0;
	subtotal=[];
	$("#guardar").hide();


	function limpiar(){

		$("#pcantidad").val("");
		$("#pprecio_compra").val("");
		$("#pprecio_venta").val("");
	}	

	function evaluar(){

		if(total>0){
			$("#guardar").show();
		}
		else{
			$("#guardar").hide();
		}
	}

	function agregar(){

		idarticulo=$("#pidarticulo").val();
		articulo=$("#pidarticulo option:selected").text();
		cantidad=$("#pcantidad").val();
		precio_compra=$("#pprecio_compra").val();
		precio_venta=$("#pprecio_venta").val();

		if(idarticulo!="" && cantidad!="" &&cantidad>0 && precio_compra!="" && precio_venta!=""){

			subtotal[contador]=(cantidad*precio_compra);
			total=total+subtotal[contador];

			var fila='<tr class="selected" id="fila'+contador+'"><td><button class="btn btn-danger" type="button" onclick="eliminar('+contador+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[contador]+'</td></tr>';
			contador++;
			limpiar();
			$("#total").html("S/. "+ total);
			evaluar();
			$("#detalles").append(fila);


		}
		else{

			alert("Error al ingresar el detalle del articulo");
		}

	}

	function eliminar(index){
		total=total-subtotal[index];
		$("#total").html("S/. "+total);
		$("#fila" + index).remove();
		evaluar();
	}

</script>
@endpush
@endsection

