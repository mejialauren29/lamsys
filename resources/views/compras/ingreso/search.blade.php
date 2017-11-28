{!! Form::open(array('url'=>'compras/ingreso','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

<div class="input-group">
	<input type="text" class="form-control" name="buscaTexto" placeholder="Buscar..." value="{{$buscaTexto}}">
	<span class="input-group-btn">
		<button type="submit" class="btn btn-primary">buscar</button>
	</span>

</div>

{{Form::close()}}