@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Nueva Escala o Unidad de Medida</h3>
		<!--validando los datos ingresados con request -->
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<!-- crear nuevo formulario para ingresar una nueva escala -->
		{!!Form::open(array('url'=>'deposito/escala', 'method'=>'POST', 'autocomplete'=>'off'))!!}
		{{Form::token()}}
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="tex" name="nombre" class="form-control" placeholder="Nombre ...">
		</div>

		<div class="form-group">
			<label for="descripcion">Descripción</label>
			<input type="tex" name="descripcion" class="form-control" placeholder="Descr ...">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>

			<button class="btn btn-default" type="reset">Limpiar</button>

			<a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
		</div>
		

		{!!Form::close()!!}
	</div>

</div>
@endsection