@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Articulo: {{$articulo->nombre}}</h3>
	</div>
</div>
		
		
		

	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-6">
			<div class="form-group">
				<label for="codigo">Código</label>
				<input readonly type="tex" name="codigo"  class="form-control" value="{{$articulo->codigo}}">
			</div>
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input readonly type="tex" name="nombre"  class="form-control"  value="{{$articulo->nombre}}">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-xs-6">
			<div class="form-group">
				<label>Categoría</label>
                <input readonly type="tex" name="categoria"  class="form-control" value="{{$categoria->nombre}}">
			</div>
		</div>

		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input readonly type="tex" name="descripcion"  class="form-control"  value="{{$articulo->descripcion}}">
			</div>
		</div>

		<div class="col-lg-6 col-sm-6 col-xs-6">
			<div class="form-group">
				<label for="imagen">Imagen</label>
                <a href ="{{asset('imagenes/articulos/'.$articulo->imagen)}}" target="_blank">
				<img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" alt="{{$articulo->nombre}}" height="100px" width="100px" class="img-thumbnail"></a>
			</div>
		</div>
	</div>

		
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="escala">Escala</label>
                    <input readonly type="tex" name="escala"  class="form-control" value = "{{$escala->nombre}}">
			</div>
			
		</div>

		<div class="row">
			<div class="col-lg-3 col-sm-3 col-xs-6">
				<div class="form-group">
					<label for="perecedero">Perecedero</label>
                    @if($articulo->perecedero == 0)
                        <input readonly type="tex" name="perecedero" class="form-control" value = "SI">
					@else
                        <input readonly type="tex"  name="perecedero" class="form-control" value = "NO">
                    @endif
				</div>
			
		</div>
	
	</div>			
		
	</div>
	
	
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<a class="btn btn-info" href="{{ URL::previous() }}">Volver</a>
			</div>
		</div>
	</div>

		
@endsection