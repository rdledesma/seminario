@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Nueva Venta</h3>
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
		<!-- crear nuevo formulario para ingresar ingreso -->
		{!!Form::open(array('url'=>'ventas/venta', 'method'=>'POST', 'autocomplete'=>'off'))!!}
		{{Form::token()}}
	<div class="row">

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="factura">Factura</label>
				<select name="factura" class="form-control selectpicker" data-live-search="true" id="factura" >
					<option value=A>A - Factura con IVA DIFERENCIADO</option>
					<option value=B>B</option>
				</select>
				
			</div>
		</div>
		<div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<label for="idpersona">Cliente</label>
				<select name="idcliente" class="form-control selectpicker" data-live-search="true">
					@foreach($personas as $persona)
						<option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="pago">Pago</label>
				<select name="tipo_pago" class="form-control selectpicker" data-live-search="true" id="pago" >
					<option value=1>Contado</option>
					<option value=2>2 Coutas Fijas</option>
					<option value=3>3 Coutas Fijas</option>
					<option value=4>4 Coutas Fijas</option>
					<option value=0>Cuenta Corriente</option>
				</select>
				
			</div>
		</div>

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="pago">Forma</label>
				<select name="efectivo" class="form-control selectpicker" data-live-search="true" >
					<option value=0>Efectivo</option>
					<option value=1>Tarjeta</option>
				</select>
				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label>Artículo</label>
						<select name="pidarticulo" class="form-control selectpicker" data-live-search="true" id="pidarticulo" >
							@foreach($articulos as $articulo)
							<option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_venta}}">{{$articulo->articulo}}</option>
							@endforeach
						</select>
					</div>
				</div >
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="cantidad">Cantidad</label>
						<input type="number" name="pcantidad" min="1" id="pcantidad" class="form-control" placeholder="cantidad">	
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="number" name="pstock" id="pstock" disabled class="form-control" >	
					</div>
				</div>

				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="precio_venta">Precio de Venta</label>
						<input type="number" name="pprecio_venta"  disabled id="pprecio_venta" class="form-control" placeholder="P. Venta">
					</div>
				</div>
				
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="descuento">Descuento</label>
						<input type="number" min="0" value="0" name="descuento" id="pdescuento" class="form-control" placeholder="P. Compra">
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
							<th>Cantidad</th>
							<th>Precio Venta</th>
							<th>Descuento</th>
							<th>Subtotal</th>
						</thead>
						<tfoot>
							<th>TOTAL</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><h4 id="total">$/. 0.00</h4> <input type="hidden" name="total_venta" id="total_venta"></></th>
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
				<button class="btn">Guardar e Imprimir</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
	</div>

		{!!Form::close()!!}
@push('scripts')
<script>
	
	$(document).ready(function(){
		$("#bt_add").click(function(){
			agregar();
		});
	});

	var cont=0;
	total=0;
	subtotal=[];
	
	$("#guardar").hide();
	mostrarValores();
	$("#pidarticulo").change(mostrarValores);

	function mostrarValores(){
		datosArticulo = document.getElementById('pidarticulo').value.split('_');
		$("#pprecio_venta").val(datosArticulo[2]);
		$("#pstock").val(datosArticulo[1]);
	}

	function agregar()
	{	
		factura = $("#factura").val();
		datosArticulo = document.getElementById('pidarticulo').value.split('_');
		idarticulo=datosArticulo[0];
		articulo=$("#pidarticulo option:selected").text();
		cantidad=$("#pcantidad").val();
		descuento=$("#pdescuento").val();
		precio_venta=$("#pprecio_venta").val();
		stock=$("#pstock").val();
		if(idarticulo!="" && cantidad!="" && descuento!="" && precio_venta!=""){
			
			if(parseInt(stock)>=parseInt(cantidad))
			{
				subtotal[cont]=(cantidad*precio_venta-descuento);
				total = total + subtotal[cont];
				var fila = '<tr class="select" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td></td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
				cont++;
				limpiar();
				if (factura == 'A')
				{
					total = total/1.21;
				}
				$("#total").html("$/ "+total);
				$("#total_venta").val(total);
				
				evaluar();
				$("#detalles").append(fila);
			}
			else
			{
				alert("La cantidad supera al stock")
			}
		}
		else
		{
			alert("Error al ingresar venta, revise los detalles del artículo")
		}
	}



	function limpiar(){
		$("#pcantidad").val("");
		$("#pprecio_venta").val("");
		$("#pdescuento").val("0");
	}

	function evaluar(){
		if(total>0)
		{
			$("#guardar").show();
		}
		else
		{
			$("#guardar").hide();
		}
	}

	function eliminar(index){
		total = total-subtotal[index];
		$("#total").html("$/ "+total);
		$("#total_venta").val(total)
		
		$("#fila" + index).remove();
		
		evaluar();
	}


</script>
@endpush
@endsection