@extends ('layouts.admin')
@section ('contenido')

	<div class="row">
		<div class="col-lg-2 col-sm-1 col-md-1 col-xs-1">
			<div class="form-group">
				<h3 for="Proveedor">Venta: {{$venta->idventa}}</h3>
			</div>
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
			<div class="form-group">
			<h3>Fecha: {{$venta->fecha_venta}}</h3>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
			<div class="form-group">
				<h3 for="Proveedor">Cliente : {{$venta->persona}}</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-2 col-sm-1 col-md-1 col-xs-1">
			<div class="form-group">
				<h3 for="Proveedor">Importe: {{$venta->total}}</h3>
			</div>
		</div>
		<div class="col-lg-2 col-sm-1 col-md-1 col-xs-1">
			<div class="form-group">
			<h3>Saldo: {{$venta->saldo}}</h3>
			</div>
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
			<div class="form-group">
				<h3>Estado: {{$venta->estado}} 
				@if($venta->estado == 'Deuda')
				<a href="" data-target="#modal-create-{{$venta->idventa}}" data-toggle="modal"><button class="btn btn-success">Registrar Pago</button></a>
				
				@endif
				</h3>
			</div>
		</div>
	</div>
	
	<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					
					<th>Fecha de Pago</th>
					<th>Monto Pagado</th>
					<th>Paga Con</th>
					<th>Su Vuelto</th>
					<th>Opciones sobre Pago</th>
				</thead>
				@foreach ($pagos as $pago)
				<tr>
					<td>{{$pago->fecha}}</td>
					<td>{{$pago->importe}}</td>
					<td>{{$pago->paga_con}}</td>
					<td>{{$pago->vuelto}}</td>
					
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$pagos->render()}}
	</div>

</div>
@endsection