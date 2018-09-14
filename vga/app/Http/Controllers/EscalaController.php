<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;



use vga\Http\Requests;
use vga\Escala;
use vga\Http\Requests\EscalaFormResquest;
use Illuminate\Support\Facades\Redirect;
use DB;

class EscalaController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request)
    {
        if($request)
		{
			$query=trim($request->get('searchText'));
            $escalas=DB::table('escala')->where('nombre','LIKE','%'.$query.'%')
			->where('estado','=','Activa')
			->orderBy('idescala','desc')
			->paginate(7);
			return view('deposito.escala.index',["escalas"=>$escalas, "searchText"=>$query]);
		}
    }

    public function create()
    {
        return view("deposito.escala.create");
    }

    public function store(EscalaFormResquest $request)
    {
        $escala = new Escala;	
		$escala->nombre = $request->get('nombre');
		$escala->descripcion = $request->get('descripcion');
		$escala->estado = 'Activa';

		$escala->save();
		return Redirect::to('deposito/escala'); //para redireccionar al listado de categorias luego de alamacenar el nuevo objeto
    }

    public function show($id)
    {
        return view("deposito.escala.show",["escala"=>Escala::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("deposito.escala.edit",["escala"=>Escala::findOrFail($id)]);
    }

    public function update(EscalaFormResquest $request, $id)
    {
        $escala =Escala::findOrFail($id);
		$escala -> nombre = $request->get('nombre');
		$escala -> descripcion = $request->get('descripcion');
		$escala -> update();

		return Redirect::to('deposito/escala');
    }

    public function destroy($id)
    {
        $escala = Escala::findOrFail($id);
		$escala->estado = 'Descativada';
		$escala->update();
		return Redirect::to('deposito/escala');
    }
}
