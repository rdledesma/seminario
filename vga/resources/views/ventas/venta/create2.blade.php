@extends ('layouts.admin')
@section ('contenido')
@push('scripts')
<script>
	var art = [];
</script>
@endpush

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

		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
			<div class="form-group">
				<label for="factura">Factura</label>
				<select name="factura" class="form-control " data-live-search="true" id="factura" >
					<option value=A>A - Factura con IVA DIFERENCIADO</option>
					<option value=B selected>B</option>
				</select>
				
			</div>
		</div>

		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<input type ="date" name="fecha"  value="<?php echo date('Y-m-d');?>" class="form-control" id="fecha">
			
			</div>
		</div>
	

		<div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<label for="idcliente">Cliente</label>
				<select name="idcliente" class="form-control selectpicker" data-live-search="true" id="idcliente">
					<option  selected value = "">Selecione Cliente</option>
					@foreach($personas as $persona)
						<option value="{{$persona->idpersona}}">{{$persona->numero_documento}} {{$persona->nombre}} {{$persona->direccion}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="pago">Pago</label>
				<select name="tipo_pago" class="form-control" data-live-search="true" id="pago" >
					<option value='Contado'>Contado</option>
					<option value='2 Cuotas'>2 Coutas Fijas</option>
					<option value='3 Cuotas'>3 Coutas Fijas</option>
					<option value='4 Cuotas'>4 Coutas Fijas</option>
					<option value='Cta. Cte.'>Cuenta Corriente</option>
				</select>
				
			</div>
		</div>

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="pago">Forma</label>
				<select name="forma_pago" class="form-control" data-live-search="true" >
					<option value='Efectivo'>Efectivo</option>
					<option value='Tarjeta'>Tarjeta</option>
				</select>
				
			</div>
		</div>
	</div>
	<div class="row" id="detalle">
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
							<th><h4 id="htotal">Total $/. 0.00</h4> <input type="hidden" name="total" id="total"></></th>
							<th></th>
							<th></th>
							<th></th>
							<th>P. Venta Total</th>
							<th><h4 id="htotalventa">$/. 0.00</h4> <input type="hidden" name="totalventa" id="totalventa"></></th>
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
	totalventa=0;
	subtotal=[];
	subtotaldescuento=[];

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
		if(factura == "B"){
			descuentotal = 1;
		}
		else{
			descuentotal = 1.21;
		}
		datosArticulo = document.getElementById('pidarticulo').value.split('_');
		idarticulo=datosArticulo[0];
		
		articulo=$("#pidarticulo option:selected").text();
		cantidad=$("#pcantidad").val();
		descuento=$("#pdescuento").val();
		precio_venta=$("#pprecio_venta").val();
		stock=$("#pstock").val();
		if(cont<10)
		{
			if(idarticulo!="" && cantidad!="" && descuento!=""){
			
			if(parseInt(stock)>=parseInt(cantidad))
			{
				subtotal[cont]=(cantidad*precio_venta-descuento);
				subtotaldescuento[cont]=(cantidad*precio_venta-descuento)/descuentotal;
		
				totalventa = (total + subtotal[cont]);
				total = totalventa/descuentotal;
				var fila = '<tr class="select" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td></td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
				cont++;
				limpiar();
				$("#htotalventa").html("$ "+totalventa);
				$("#totalventa").val(totalventa);

				$("#htotal").html("TOTAL$/ "+total);
				$("#total").val(total);
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
		else{
			alert("Guarde la Factura, Ya tiene 10 artículos")
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
		total = (total-subtotal[index]);
		preciofinal = total/descuentotal
		$("#htotal").html("TOTAL$/"+total);
		$("#htotalventa").html("TOTAL$/"+preciofinal);
		$("#fila" + index).remove();
		evaluar();
	}


</script>
@endpush
@endsection