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
					<td>{{$ven->persona}}</td>
					<td>{{$ven->fecha_venta}}</td>
					<td>{{$ven->estado}}</td>
					<td>{{$ven->total}}</td>
					<td>{{$ven->saldo}}</td>
					<td>
						<a href="{{URL::action('PagoCtaCorrienteController@show',$ven->idventa)}}"><button class="btn btn-info">Ver</button></a>
						
						<a href=""><button class="btn btn-success">Reg. Pago</button></a>

						
					</td>
					
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}
	</div>

</div>

		
	

@endsection