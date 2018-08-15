<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;

use vga\Http\Requests;

use vga\Http\Requests\PersonaFormRequest;
use Illuminate\Support\Facades\Redirect;
use vga\Persona;
use DB;

class ClienteController extends Controller
{
    public function __construct()
	{
		
	}

	public function index(Request $request)
	{
		if($request)
		{
			$query=trim($request->get('searchText'));
			$personas=DB::table('persona')
			->where('estado','=','Activo')
			->where('nombre','LIKE','%'.$query.'%')
			->orwhere('numero_documento','LIKE','%'.$query.'%')
			->orderBy('idpersona','desc')
			->paginate(7);
			return view('ventas.cliente.index',["personas"=>$personas, "searchText"=>$query]);
		}
	}

	public function create()
	{
		return view("ventas.cliente.create");
	}

	public function store(PersonaFormRequest $request)
	{
		$persona = new Persona;	
		$persona->nombre = $request->get('nombre');
		$persona->direccion = $request->get('direccion');
		$persona->tel = $request->get('tel');
		$persona->numero_documento = $request->get('numero_documento');
		$persona->email = $request->get('email');
		$persona->estado = 'Activo';
		$persona->save();
		return Redirect::to('ventas/cliente'); //para redireccionar al listado de categorias luego de almacenar el nuevo objeto
	}

	public function show($id)
	{
		return view("ventas.cliente.show",["persona"=>Persona::findOrFail($id)]);
	}

	public function edit($id)
	{
		return view("ventas.cliente.edit",["persona"=>Persona::findOrFail($id)]);
	}

	public function update(PersonaFormRequest $request, $id)
	{
		$persona =Persona::findOrFail($id);
		
		$persona->nombre = $request->get('nombre');
		$persona->direccion = $request->get('direccion');
		$persona->tel = $request->get('tel');
		$persona->numero_documento = $request->get('numero_documento');
		$persona->email = $request->get('email');

		$persona->update();
		return Redirect::to('ventas/cliente');
	}

	public function destroy($id)
	{
		$persona = Persona::findOrFail($id);
		$persona->estado = 'Inactivo';
		$persona->update();
		return Redirect::to('ventas/cliente');
	}
}
