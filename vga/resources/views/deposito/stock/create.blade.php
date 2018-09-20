@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Nueva Modificación de Stock</h3>
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
{!!Form::open(array('url'=>'deposito/stock', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true'))!!}
		{{Form::token()}}


	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-2 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label>Artículo</label>
						<select name="pidarticulo" class="form-control selectpicker" data-live-search="true" id="pidarticulo" >
							@foreach($articulos as $articulo)
							<option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->escala}}">{{$articulo->articulo}}</option>
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
						<label for="nuevo">Nuevo Stock</label>
						<input type="number" min="0" name="pnuevo_stock" id="pnuevo_stock" class="form-control" placeholder="Nueva Cantidad">
					</div>
				</div>
				
				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<label for="motivo">Motivo</label>
						<select id="pmotivo" class="form-control " name="pmotivo">
							<option value="" selected></option>
							<option value="Perdida">Pérdida</option>
							<option value="Ruptura">Ruptura</option>
							<option value="Venciento">Venciento</option>
							<option value="Otro">Otro</option>
						</select>
					</div>
				</div>

				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
						<button type="button" id="bt_add" class="btn btn-success" name="Agregar">Agregar</button>
					</div>
				</div>
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color:#A9D0F5">
							<th>Opciones</th>
							<th>Artículo</th>
							<th>Escala</th>
							<th>Stock</th>
							<th>Nuevo Stock</th>
							<th>Motivo</th>
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
				<button class="btn btn-primary" type="submit" name="Guardar">Guardar</button>

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
		$("#pstock").val(datosArticulo[1]);
		$("#pescala").val(datosArticulo[2]);
	}

	function agregar()
	{	
		datosArticulo = document.getElementById('pidarticulo').value.split('_');
		idarticulo=datosArticulo[0];
		articulo=$("#pidarticulo option:selected").text();
		
		nueva_cantidad=$("#pnuevo_stock").val();
		stock=$("#pstock").val();
		motivo = $("#pmotivo").val();
		if(idarticulo!="" && nueva_cantidad!=""){
			if($("#pmotivo option:selected").text()!="")
			{
				var fila = '<tr class="select" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="hidden" name="stock[]" value="'+stock+'">'+stock+'</td><td><input type="hidden" name="nueva_cantidad[]" value="'+nueva_cantidad+'">'+nueva_cantidad+'</td><td><input type="hidden" name="motivo[]" value="'+motivo+'">'+motivo+'</td></tr>';
				$("#detalles").append(fila);
				cont++;
				limpiar();
				evaluar();
			}
			else
			{
				alert("Error al modificar el Stock. Debe Indicar Motivo de Modificación")
			}
				
		}
		else
		{
			alert("Error al modificar el Stock. Revise Nueva Cantidad")
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
		$("#pmotivo").val("");
		$("#pnuevo_stock").val("");
	}

</script>
@endpush

@endsection
