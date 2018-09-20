@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Modificación de Lista de Precios</h3>
		<!--validando los datos ingresados con request -->
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
		<!-- crear nuevo formulario para ingresar un nuevo articulo -->
		{!!Form::open(array('url'=>'deposito/lista', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true'))!!}
		{{Form::token()}}


	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label>Artículo</label>
						<select name="pidarticulo" class="form-control selectpicker" data-live-search="true" id="pidarticulo" >
							@foreach($articulos as $articulo)
							<option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_venta}}_{{$articulo->escala}}">{{$articulo->articulo}}</option>
							@endforeach
						</select>
					</div>
				</div >
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="number" name="pstock" id="pstock" class="form-control" disabled="true">	
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="escala">Escala</label>
						<input type="tex" name="pescala" id="pescala" disabled class="form-control" >	
					</div>
				</div>

				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="precio_venta">Precio de Venta</label>
						<input type="number" name="pprecio_venta" id="pprecio_venta"  disabled class="form-control" placeholder="P. Venta">
					</div>
				</div>
				
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="nuevo">Nuevo Precio</label>
						<input type="number" min="0" value="0" name="pnuevo_precio" id="pnuevo_precio" class="form-control" placeholder="P. Compra">
					</div>
				</div>
				
				
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<button type="button" id="bt_add" class="btn btn-success">Agregar</button>
					</div>
				</div>
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color:#A9D0F5">
							<th>Opciones</th>
							<th>Artículo</th>
							<th>Stock</th>
							<th>Escala</th>
							<th>Precio Venta</th>
							<th>Nuevo Precio</th>
						</thead>
						<tfoot>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tfoot>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-12" id="guardar">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<button class="btn btn-primary" type="submit">Guardar</button>

				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
	</div>

		{!!Form::close()!!}


@push ('scripts')
<script>

$(document).ready(function(){
		$("#bt_add").click(function(){
			agregar();
		});
	});

	var cont=0;

	$("#guardar").hide();
	mostrarValores();
	$("#pidarticulo").change(mostrarValores);

function mostrarValores(){
		datosArticulo = document.getElementById('pidarticulo').value.split('_');
		$("#pprecio_venta").val(datosArticulo[2]);
		$("#pstock").val(datosArticulo[1]);
		$("#pescala").val(datosArticulo[3]);
	}

	function agregar()
	{	
		datosArticulo = document.getElementById('pidarticulo').value.split('_');
		idarticulo=datosArticulo[0];
		articulo=$("#pidarticulo option:selected").text();
		escala=$("#pescala").val();
		antiguo_precio=$("#pprecio_venta").val();
		nuevo_precio=$("#pnuevo_precio").val();
		stock=$("#pstock").val();
		if(idarticulo!="" && nuevo_precio!=""){
				var fila = '<tr class="select" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="hidden" name="stock[]" value="'+stock+'">'+stock+'</td><td><input type="hidden" name="escala[]" value="'+escala+'">'+escala+'</td><td><input type="hidden" name="antiguo_precio[]" value="'+antiguo_precio+'"></td><td><input type="hidden" name="nuevo_precio[]" value="'+nuevo_precio+'">'+nuevo_precio+'</td></tr>';
				$("#detalles").append(fila);
				cont++;
				limpiar();
				evaluar();
		}
		else
		{
			alert("Error al ingresar venta, revise los detalles del artículo")
		}
	}

	function evaluar(){
		if(cont>0)
		{
			$("#guardar").show();
		}
		else
		{
			$("#guardar").hide();
		}
	}

	function eliminar(index){
		$("#fila" + index).remove();
		cont--;
		evaluar();
	}

	function limpiar(){
		$("#pstock").val("");
		$("#pprecio_venta").val("");
		$("#pnuevo_precio").val("");
	}

</script>
@endpush

@endsection
