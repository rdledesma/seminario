<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;

use vga\Http\Requests;
use vga\Articulo;
use vga\Http\Requests\ArticuloFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Mpdf\Mpdf;
class ArticuloController extends Controller
{
    public function __construct()
	{

	}

	public function index(Request $request)
	{
		if($request)
		{
			$query=trim($request->get('searchText'));
			$articulos=DB::table('articulo as a')
			->join('categoria as c','a.idcategoria','=','c.idcategoria')
			->join('escala as es','a.idescala','=','es.idescala')
			->select('a.idarticulo','a.nombre','a.perecedero','a.stock','c.nombre as categoria','a.descripcion','a.imagen','es.nombre as escala','a.estado', 'a.codigo')
			->where('a.nombre','LIKE','%'.$query.'%')
			->orwhere('a.codigo','LIKE','%'.$query.'%')
			->where('a.estado','=','Activo')
			->orderBy('a.idarticulo','desc')
			->paginate(7);
			return view('deposito.articulo.index',["articulos"=>$articulos, "searchText"=>$query]);
		}
	}

	public function create()
	{
		$categorias = DB::table('categoria')->where('condicion','=','1')->get();
		$escalas = DB::table('escala')->where('estado','=','Activa')->get();
		return view("deposito.articulo.create",["categorias"=>$categorias, "escalas"=>$escalas]);
	}

	public function store(ArticuloFormRequest $request)
	{
		$articulo = new Articulo;	
		$articulo->idcategoria = $request->get('idcategoria');
		$articulo->idescala = $request->get('idescala');
        $articulo->nombre = $request->get('nombre');
		$articulo->perecedero = $request->get('perecedero'); 
		$articulo->estado = 'Activo';
		
        $articulo->stock = 0;
		$articulo->descripcion = $request->get('descripcion');
		$articulo->codigo = $request->get('codigo');
		if(Input::hasFile('imagen')){
			$file=Input::file('imagen');
			$file->move(public_path().'/imagenes/articulos',$file->getClientOriginalName());
			$articulo->imagen = $file->getClientOriginalName();
		}
		$articulo->precio_venta = 0;
		$articulo->save();
		return Redirect::to('deposito/articulo'); //para redireccionar al listado de categorias luego de alamacenar el nuevo objeto
	}

	public function show($id)
	{
		return view("deposito.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
	}

	public function edit($id)
	{

		$articulo = Articulo::findOrFail($id);
		$categorias=DB::table('categoria')->where('condicion','=','1')->get();
		$escalas = DB::table('escala')->where('estado','=','Activa')->get();
		return view("deposito.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias, "escalas"=>$escalas]);
	}	

	public function update(ArticuloFormRequest $request, $id)
	{
		$articulo = Articulo::findOrFail($id);

		$articulo->idcategoria = $request->get('idcategoria');
		$articulo->nombre = $request->get('nombre');
		$articulo->stock = $request->get('stock');
		$articulo->descripcion = $request->get('descripcion');
        $articulo->estado = 'Activo';
        $articulo->idescala = $request->get('idescala');
		$articulo->perecedero = $request->get('perecedero');
		if(Input::hasFile('imagen')){
			$file=Input::file('imagen');
			$file->move(public_path().'/imagenes/articulos',$file->getClientOriginalName());
			$articulo->imagen = $file->getClientOriginalName();
		}
		$articulo->codigo = $request->get('codigo');
		$articulo -> update();

		return Redirect::to('deposito/articulo');
	}

	public function destroy($id)
	{
		$articulo = Articulo::findOrFail($id);
		$articulo->estado = 'Inactivo';
		$articulo->update();
		return Redirect::to('deposito/articulo');
	}

	public function reporte(){
		
		$html = view('deposito.articulo.reporte');
        $mpdf = new mPDF();
        // $mpdf->SetTopMargin(5);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        // dd($mpdf);
        $mpdf->Output('hola.pdf',"I");
	}
}
