@extends ('layouts.admin')
@section ('contenido')


<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Ventas <a href="venta/create"><button class="btn btn-success">Nueva Venta</button></a></h3>
		@include('ventas.venta.search')
	</div>

</div>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Estado</th>
					<th>Factura</th>
					<th>Total</th>
					<th>SALDO</th>
					<th>Opciones</th>
				</thead>
				@foreach ($ventas as $ven)
				<tr>
					<td>{{$ven->idventa}}</td>
					<td>{{$ven->fecha_venta}}</td>
					<td>{{$ven->nombre}}</td>
					<td>{{$ven->estado}}</td>
					<td>{{$ven->factura}}</td>
					<td>{{$ven->total}}</td>
					<th>{{$ven->saldo}}</td>
					<td>
						<a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary">Ver</button></a>
						<a href="{{URL::action('VentaController@imprimir',$ven->idventa)}}" target="_blank"><button class="btn btn-info">Imprimir</button></a>
						@if($ven->estado != 'Anulado')
							<a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
							
						@endif

						
					</td>
				</tr>
				@include('ventas.venta.modal')
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}
	</div>

</div>


@endsection