@extends ('layouts.admin')
@section ('contenido')


<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Ventas de Cuenta Corriente</h3>
		
	</div>

</div>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					
					<th>Nombre y Número</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th>Total</th>
					<th>SALDO</th>
					<th>Opciones sobre Venta</th>
				</thead>
				@foreach ($ventas as $ven)
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