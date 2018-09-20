@extends ('layouts.admin')
@section ('contenido')

	<div class="row">
		<div class="col-lg-2 col-sm-1 col-md-1 col-xs-1">
			<div class="form-group">
				<h3 for="Proveedor">Venta: {{$ven->idventa}}</h3>
			</div>
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
			<div class="form-group">
			<h3>Fecha: 
			<?php
				$date = new DateTime($ven->fecha_venta);
				echo $date->format('d-m-Y H:i');
			?>
			</h3>
			</div>
		</div>
		<div class="col-lg-5 col-sm-4 col-md-4 col-xs-4">
			<div class="form-group">
				<h3 for="Proveedor">Cliente: {{$ven->persona}}</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-sm-1 col-md-1 col-xs-1">
			<div class="form-group">
				<h3 for="Proveedor" class="text-success">Importe: {{$ven->total}}</h3>
			</div>
		</div>
		<div class="col-lg-3 col-sm-1 col-md-1 col-xs-1">
			<div class="form-group">
			<h3 class="text-danger">Saldo: {{$ven->saldo}}</h3>
			</div>
		</div>
		<div class="col-lg-3 col-sm-4 col-md-4 col-xs-4">
			<div class="form-group">
				<h3 class="text-primary">Estado: {{$ven->estado}} 
				@if($ven->estado == 'Deuda')
				<a href="{{URL::action('PagoCtaCorrienteController@crear',$ven->idventa)}}" data-target="#modal-create-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-success">Reg. Pago</button></a>
				@include('pagos.corriente.create')
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
					@if($pago->estado!='Anulado')
					<td>
					<a href="{{URL::action('PagoCtaCorrienteController@destroy',$pago->idpago)}}" data-target="#modal-delete-{{$pago->idpago}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					@include('pagos.corriente.modal')
					</td>
					@else
					<td class="danger">Pago Anulado</td>
					@endif
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$pagos->render()}}
	</div>

</div>
@endsection