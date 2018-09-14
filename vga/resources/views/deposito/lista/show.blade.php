@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Fecha Modificación: </h3>
	</div>
</div>


<div class="row">
	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
		<div class="table-resposive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Articulo</th>
					<th>Precio Antiguo</th>
					<th>Precio Nuevo</th>
				</thead>
				
				@foreach ($detalle as $det)
				<tr>
					<td>{{$det->articulo}}</td>
					<td>{{$det->antiguo_precio}}</td>
					<td>{{$det->nuevo_precio}}</td>
				</tr>
				@endforeach
				
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="form-group">
		<a class="btn btn-danger" href="{{ URL::previous() }}">Volver</a>
		</div>
	</div>
</div>
@endsection