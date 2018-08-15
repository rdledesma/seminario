@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Stock 
		<a href="stock/create"><button class="btn btn-success">Nueva Modificación</button></a> 
		<a href="stock/show"><button class="btn btn-primary">Ver Historial</button></a>
		</h3>
		@include('deposito.stock.search')
	</div>

</div>

<div class="row">
	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Medida o Escala</th>
					<th>Stock</th>
				</thead>
				@foreach ($articulos as $art)
				<tr>
					<td>{{$art->codigo}}</td>
					<td>{{$art->nombre}}</td>
					<td>{{$art->escala}}</td>
					<td>{{$art->stock}}</td>
					
				</tr>
				@include('deposito.stock.modal')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>

</div>


@endsection