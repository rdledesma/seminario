@extends ('layouts.admin')
@section ('contenido')


<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Ventas de Cuenta Corriente</h3>
		
	</div>

</div>

<div class="row">
	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					
					<th>Nombre y Número</th>
					<th>Fecha Venta</th>
					<th>Estado</th>
					<th>Total</th>
					<th>SALDO</th>
					<th>Opciones sobre Venta</th>
				</thead>
				@foreach ($ventas as $ven)
				<tr>
					<td>{{$ven->persona}}</td>
					<td>
					<?php
						$date = new DateTime($ven->fecha_venta);
						echo $date->format('d-m-Y H:i');
					?>
					</td>
					@if($ven->estado=='Deuda')
						<td class = "danger text-danger">{{$ven->estado}}</td>
					@elseif($ven->estado=='Pagado')
						<td class = "success text-success">{{$ven->estado}}</td>
					@else
						<td>{{$ven->estado}}</td>
					@endif
					<td>{{$ven->total}}</td>
					<td>{{$ven->saldo}}</td>
					<td>
						<a href="{{URL::action('PagoCtaCorrienteController@show',$ven->idventa)}}"><button class="btn btn-info">Ver</button></a>
						@if($ven->estado=='Deuda')
						<a href="{{URL::action('PagoCtaCorrienteController@crear',$ven->idventa)}}" data-target="#modal-create-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-success">Reg. Pago</button></a>
						@include('pagos.corriente.create')
						@endif
						
					</td>
					
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}
	</div>

</div>


@endsection