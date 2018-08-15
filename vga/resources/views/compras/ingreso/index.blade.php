@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Ingresos <a href="ingreso/create"><button class="btn btn-success">Nuevo Ingreso</button></a></h3>
		@include('compras.ingreso.search')
	</div>

</div>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th style="display:none;">ID</th>
					<th>Factura</th>
					<th>Proveedor</th>
					<th>Fecha</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				@foreach ($ingresos as $ing)
				<tr>
					<td style="display:none;">{{$ing->idingreso}}</td>
					<td>{{$ing->nro_factura}}</td>
					<td>{{$ing->nombre}} {{$ing->numero_documento}}</td>
					<td>{{$ing->fecha_ingreso}}</td>
					<td>{{$ing->total}}</td>
					<td>{{$ing->estado}}</td>
					<td>
						<a href="{{URL::action('IngresoController@show',$ing->idingreso)}}"><button class="btn btn-primary">Ver</button></a>
						
						@if($ing->estado == 'Activo')
							<a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
						@endif
					</td>
				</tr>
				@include('compras.ingreso.modal')
				@endforeach
			</table>
		</div>
		{{$ingresos->render()}}
	</div>

</div>


@endsection