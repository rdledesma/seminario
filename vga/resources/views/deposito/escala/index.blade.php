@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Escalas o Unidades Medida <a href="escala/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('deposito.escala.search')
	</div>

</div>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
				@foreach ($escalas as $esc)
				<tr>
					<td>{{$esc->idescala}}</td>
					<td>{{$esc->nombre}}</td>
					<td>{{$esc->descripcion}}</td>
					<td>
						<a href="{{URL::action('EscalaController@edit',$esc->idescala)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$esc->idescala}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('deposito.escala.modal')
				@endforeach
			</table>
		</div>
		{{$escalas->render()}}
	</div>

</div>


@endsection