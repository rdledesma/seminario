@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Editar Articulo:{{$articulo->nombre}}</h3>
		<!--validando los datos ingresados con request -->
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
</div>
		@endif
		<!-- crear nuevo formulario para editar (PATCH) una nueva categoria -->
		{!!Form::model($articulo, ['method'=>'PATCH', 'route'=>['deposito.articulo.update',$articulo->idarticulo],'files'=>'true'])!!}  
		{{Form::token()}}

	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-6">
			<div class="form-group">
				<label for="codigo">Código</label>
				<input type="tex" name="codigo" required class="form-control" placeholder="Código ..." value="{{$articulo->codigo}}">
			</div>
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="tex" name="nombre" required class="form-control" placeholder="Nombre ..." value="{{$articulo->nombre}}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
			<div class="form-group">
				<label>Categoría</label>
				<select name="idcategoria" class="form-control">
					@foreach($categorias as $cat)
						@if($cat->idcategoria==$articulo->idcategoria)
							<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
						@else
							<option value="{{$cat->idcategoria}}">{{$cat->nombre}}>
							</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="tex" name="descripcion"  class="form-control" placeholder="Descripción del Artículo..." value="{{$articulo->descripcion}}">
			</div>
		</div>

		<div class="col-lg-6 col-sm-6 col-xs-6">
			<div class="form-group">
				<label for="imagen">Imagen</label>
				<input type="file" name="imagen"  class="form-control" values = "{{$articulo->imagen}}">
			</div>
		</div>
	</div>

		
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="escala">Escala</label>
				<select name="idescala" class="form-control">
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
	
					<select name="perecedero" class="form-control" id=pere>
						@if($articulo->perecedero == 0)
							<option value=0 selected >NO</option>
							<option value=1>SI</option>
						@else
							<option value=0>NO</option>
							<option value=1 selected>SI</option>
						@endif
					</select>
				</div>
			
		</div>
	
	</div>			
		
	</div>
	
	
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-default " type="reset">Restaurar</button>
				<a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
			</div>
		</div>
	</div>

		{!!Form::close()!!}
@endsection