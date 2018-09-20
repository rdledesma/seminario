{!! Form::open(array('url'=>'deposito/articulo', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search'))!!}

<div class="form-group" id="formulario">
	<div class="input-group">
		<input type="text" id = "buscar" class= "form-control" name="searchText" placeholder="Buscar ..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>

</div>


{{Form::close()}}

@push('scripts')
<script>
$(document).ready(function(){
		$("#buscar").focus();
	});

</script>
@endpush
