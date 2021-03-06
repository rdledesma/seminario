@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Articulos <a href="articulo/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('deposito.articulo.search')
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
					<th>Categoría</th>
					<th>Imagen</th>
					<th>Opciones</th>
				</thead>
				@foreach ($articulos as $art)
				<tr>
					<td>{{$art->codigo}}</td>
					<td>{{$art->nombre}}</td>
					<td>{{$art->escala}}</td>
					<td>{{$art->categoria}}</td>
					<td>
						<a href ="{{asset('imagenes/articulos/'.$art->imagen)}}" target="_blank">
						<img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="100px" width="100px" class="img-thumbnail">
						</a>
					</td>
					
					<td>
						<a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						<a href="{{URL::action('ArticuloController@show',$art->idarticulo)}}" ><button class="btn btn-default">Ver</button></a>
					</td>
				</tr>
				@include('deposito.articulo.modal')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>

</div>


@endsection