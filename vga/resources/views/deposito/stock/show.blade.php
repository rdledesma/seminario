@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Historial de Modificaciones de Stock</h3>
		@include('deposito.stock.search')
	</div>
</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Articulo</th>
					<th>Antigua Cantidad</th>
					<th>Nueva Cantidad</th>
					<th>Motivo</th>
				</thead>
				
				@foreach ($modificaciones as $mod)
				<tr>
					<td>{{$mod->fecha}}</td>
					<td>{{$mod->articulo}}</td>
					<td>{{$mod->antigua_cantidad}}</td>
					<td>{{$mod->nueva_cantidad}}</td>
					<td>{{$mod->motivo}}</td>
				</tr>
				@endforeach
				
			</table>
		</div>
		{{$modificaciones->render()}}
	</div>
</div>

<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
		<a class="btn btn-danger" href="/deposito/stock">Volver</a>
		</div>
	</div>
</div>
@endsection