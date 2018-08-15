@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Nuevo Proveedor</h3>
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
	</div>
</div>
		<!-- crear nuevo formulario para ingresar un cliente -->
		{!!Form::open(array('url'=>'compras/proveedor', 'method'=>'POST', 'autocomplete'=>'off'))!!}
		{{Form::token()}}
		<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="tex" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre ...">
			</div>
			<div class="form-group">
				<label for="numero_documento">CUIT</label>
				<input type="tex" required name="numero_documento"  value="{{old('numero_documento')}}" class="form-control" placeholder="CUIT ...">
			</div>
		</div>
		
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="direccion">Direccion</label>
				<input type="tex" name="direccion" required value="{{old('direccion')}}" class="form-control" placeholder="Direccion ...">
			</div>
		</div>
		
		<div class="col-lg-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label>Telefono</label>
				<input type="tex" name="tel"  value="{{old('tel')}}" class="form-control" placeholder="Tel...">
			</div>
		</div>

		<div class="col-lg-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email"  value="{{old('email')}}" class="form-control" placeholder="Email...">
			</div>
		</div>

		
	</div>

	<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
			<button class="btn btn-primary" type="submit" id=Guardar>Guardar</button>
				<button class="btn btn-default " type="reset">Limpiar</button>
				<a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
			</div>
		</div>
	</div>

		{!!Form::close()!!}
@endsection