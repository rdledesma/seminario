<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;

use vga\Http\Requests;
use vga\Categoria;
use vga\Http\Requests\CategoriaFormRequest;
use Illuminate\Support\Facades\Redirect;
use DB;


class CategoriaController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request)
    {
        if($request)
		{
			$query=trim($request->get('searchText'));
			$categorias=DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
			->where('condicion','=','1')
			->orderBy('idcategoria','desc')
			->paginate(7);
			return view('deposito.categoria.index',["categorias"=>$categorias, "searchText"=>$query]);
		}
    }

    public function create()
    {
        return view("deposito.categoria.create");
    }

    public function store(CategoriaFormRequest $request)
    {
        $categoria = new Categoria;	
		$categoria->nombre = $request->get('nombre');
		$categoria->descripcion = $request->get('descripcion');
		$categoria->condicion = '1';

		$categoria->save();
		return Redirect::to('deposito/categoria'); //para redireccionar al listado de categorias luego de alamacenar el nuevo objeto
    }

    public function show($id)
    {
        return view("deposito.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("deposito.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }

    public function update(CategoriaFormRequest $request, $id)
    {
        $categoria =Categoria::findOrFail($id);
		$categoria -> nombre = $request->get('nombre');
		$categoria -> descripcion = $request->get('descripcion');
		$categoria -> update();

		return Redirect::to('deposito/categoria');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
		$categoria->condicion = 0;
		$categoria->update();
		return Redirect::to('deposito/categoria');
    }
}
