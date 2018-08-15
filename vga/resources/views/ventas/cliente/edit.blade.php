@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Editar Cliente: {{$persona->nombre}}</h3>
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
		<!-- crear nuevo formulario para editar (PATCH) una nueva categoria -->
		{!!Form::model($persona, ['method'=>'PATCH', 'route'=>['ventas.cliente.update',$persona->idpersona]])!!}  
		{{Form::token()}}	
		<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="tex" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre ...">
			</div>
			<div class="form-group">
				<label for="nombre">DNI/CUIT</label>
				<input type="tex" name="numero_documento"  value="{{$persona->numero_documento}}" class="form-control" placeholder="DNI ...">
			</div>
			
		</div>
		
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="direccion">Direccion</label>
				<input type="tex" name="direccion" required value="{{$persona->direccion}}" class="form-control" placeholder="Direccion ...">
			</div>
		</div>
		
		<div class="col-lg-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label>Telefono</label>
				<input type="tex" name="tel"  value="{{$persona->tel}}" class="form-control" placeholder="Tel...">
			</div>
		</div>

		<div class="col-lg-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email"  value="{{$persona->email}}" class="form-control" placeholder="Email...">
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
@endsection()