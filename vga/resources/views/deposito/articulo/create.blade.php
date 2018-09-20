@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Nuevo Artículo</h3>
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
		<!-- crear nuevo formulario para ingresar un nuevo articulo -->
		{!!Form::open(array('url'=>'deposito/articulo', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true'))!!}
		{{Form::token()}}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-6">
			<div class="form-group">
				<label for="codigo">Código</label>
				<input type="tex" name="codigo" required class="form-control" placeholder="Codigo ..." value="{{old('codigo')}}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="tex" name="nombre" required class="form-control" placeholder="Nombre ..." value="{{old('nombre')}}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
			<div class="form-group">
				<label>Categoría</label>
				<select name="idcategoria" class="form-control" required>
					@foreach($categorias as $cat)
						<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="tex" name="descripcion"  class="form-control" placeholder="Descripción del Artículo..." value="{{old('descripcion')}}">
			</div>
		</div>

		<div class="col-lg-2 col-sm-2 col-xs-2">
			<div class="form-group">
				<label for="imagen">Imagen</label>
				<input type="file" name="imagen"  class="form-control">
			</div>
		</div>
	</div>

		
	<div class="row">
		<div class="col-lg-3 col-sm-3 col-xs-3">
			<div class="form-group">
				<label for="escala">Escala</label>
				<select name="idescala" class="form-control" required>
					@foreach($escalas as $esc)
						<option value="{{$esc->idescala}}">{{$esc->nombre}}</option>
					@endforeach
				</select>
			</div>
			
		</div>

		<div class="row">
			<div class="col-lg-3 col-sm-3 col-xs-6">
				<div class="form-group">
					<label for="perecedero">Perecedero</label>
					<select name="perecedero" class="form-control" required>
						<option value=1>SI</option>
						<option value=0 selected>NO</option>
					</select>
				</div>
				
			</div>
		</div>
	
	</div>			
		
	
	
	
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-default " type="reset">Limpiar</button>
				<a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
			</div>
		</div>
	</div>
	

		{!!Form::close()!!}
@endsection
