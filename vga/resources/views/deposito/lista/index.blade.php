@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Precios
		<a href="lista/create"><button class="btn btn-success">Nueva Modificación</button></a> 
		<a href="lista/showlista"><button class="btn btn-primary">Ver Historial</button></a>
		</h3>
		@include('deposito.lista.search')
	</div>

</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Medida o Escala</th>
					<th>Stock</th>
					<th>Precio Venta</th>
				</thead>
				@foreach ($articulos as $art)
				<tr>
					<td>{{$art->codigo}}</td>
					<td>{{$art->nombre}}</td>
					<td>{{$art->escala}}</td>
					<td>{{$art->stock}}</td>
					<td>{{$art->precio_venta}}</td>
				</tr>
				
				@endforeach
			</table>
		</div>
			
	</div>

</div>


@endsection