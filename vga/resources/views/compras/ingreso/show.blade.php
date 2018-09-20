@extends ('layouts.admin')
@section ('contenido')

	<div class="row">
		<div class="col-lg-2 col-sm-1 col-md-1 col-xs-1">
			<div class="form-group">
				<h3 name="factura">Ingreso: {{$ingreso->nro_factura}}</h3>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-3 col-xs-3">
			<div class="form-group">
			<h3 name="fecha">Fecha: <?php
					$date = new DateTime($ingreso->fecha_ingreso);
					echo $date->format('d-m-Y H:i');
					?></h3>
			</div>
		</div>
		
		<div class="col-lg-3 col-sm-2 col-md- col-xs-2">
			<div class="form-group">
				<h3 class="bg-primary" name="estado">Estado: {{$ingreso->estado}}</h3>
			</div>
		</div>
		
	</div>

	<div class="row">
	<div class="col-lg-6 col-sm-6 col-md-4 col-xs-4">
			<div class="form-group">
				<h3 for="Proveedor" name="proveedor">Proveedor: {{$persona->nombre}} {{$persona->numero_documento}}</h3>
			</div>
		</div>
		
	<div class="col-lg-4 col-sm-6 col-md-4 col-xs-4">
			<div class="form-group">
				<h3 for="direccion">{{$persona->direccion}} {{$persona->email}}</h3>
			</div>
		</div>
		
	</div>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color:#A9D0F5">
							
							<th>Artículo</th>
							<th>Cantidad</th>
							<th>Precio Compra</th>
							<th>Precio Venta</th>
							<th>Subtotal</th>
						</thead>
						<tfoot>
							
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><h4 id="total">{{$ingreso->total}}</h4></th>
						</tfoot>
						<tbody>
							@foreach($detalle as $det)
							<tr>
								<td name="articulo">{{$det->articulo}}</td>
								<td name="cantidad">{{$det->cantidad}}</td>
								<td name="precio_compra">{{$det->precio_compra}}</td>
								<td name="precio_venta">{{$det->precio_venta}}</td>
								<td name="subtotal">{{$det->subtotal}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
	</div>
	<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
		<a class="btn btn-danger" href="{{ URL::previous() }}">Volver</a>
		</div>
	</div>
@endsection