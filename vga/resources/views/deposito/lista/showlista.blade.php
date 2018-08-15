@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Historial Lista de Precios</h3>
	</div>
</div>


<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Fecha</th>
					<th>Cantidad Modificados</th>
				</thead>
				
				@foreach ($lista as $l)
				<tr>
					<td>{{$l->idlista_precio}}</td>
					<td>{{$l->fecha_mod}}</td>
					<td>{{$l->cantidad_mod}}</td>
					<td><a href="{{URL::action('PrecioController@detalle',$l->idlista_precio)}}"><button class="btn btn-primary">Ver</button></a></td>
				</tr>
				@endforeach
				
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<a class="btn btn-danger" href="/deposito/lista">Volver</a>
	</div>
</div>
@endsection