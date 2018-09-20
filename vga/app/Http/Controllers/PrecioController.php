<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;

use vga\Http\Requests;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use vga\Http\Requests\PrecioFormRequest;
use vga\DetallePrecio;
use vga\Precio;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class PrecioController extends Controller
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
			->select('a.idarticulo','a.codigo','a.nombre','a.stock','c.nombre as categoria','es.nombre as escala','a.precio_venta')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->where('a.estado','=','Activo')
            ->orWhere('a.codigo','LIKE','%'.$query.'%')
            ->where('a.estado','=','Activo')
            ->orderBy('a.idarticulo','desc')
            ->paginate(7);
			return view('deposito.lista.index',["articulos"=>$articulos ,"searchText"=>$query]);
		}
	}

	public function create()
	{
        $articulos = DB::table('articulo as art')
		->join('escala as es','art.idescala','=','es.idescala')
		->select('art.idarticulo', DB::raw('CONCAT(art.nombre," ",art.codigo," ",es.nombre) AS articulo'), 'art.stock' ,'es.nombre as escala','art.precio_venta')
		->where('art.estado','=','Activo')
		->get();
		return view("deposito.lista.create",["articulos"=>$articulos]);
	}

	
	public function store(PrecioFormRequest $request)
	{
		try{
			DB::beginTransaction();
			$precio=new Precio;
			$mytime = Carbon::now('America/Argentina/Salta');
			$precio->fecha_mod = $mytime->toDateTimeString();
			$precio->cantidad_mod = count($request->get('idarticulo'));
			$precio->save();

			$idarticulo = $request->get('idarticulo');
			$antiguo_precio = $request->get('antiguo_precio');
			$nuevo_precio = $request->get('nuevo_precio');

			$cont = 0;

			while ($cont<count($idarticulo)) {
				
				$detalle = new DetallePrecio;
				$detalle->idlista_precio = $precio->idlista_precio;
				$detalle->idarticulo = $idarticulo[$cont];
				$detalle->antiguo_precio = $antiguo_precio[$cont];
				$detalle->nuevo_precio = $nuevo_precio[$cont];
				$detalle->save();
				$cont = $cont+1;
			}
			DB::commit();
		}	catch(Exception $e){
			DB::rollback();
			}
		return Redirect::to('deposito/lista');
	}


	public function show(Request $request)
	{
	
			$query = trim($request->get('searchText'));
			$lista= DB::table('precio as p')
			->join('detalle_precio as dp','dp.idlista_precio','=','p.idlista_precio')
			->join('articulo as art','art.idarticulo','=','dp.idarticulo')
			->join('escala as es','art.idescala','=','es.idescala')
			->select('p.fecha_mod as fecha', DB::raw('CONCAT(art.codigo," ",art.nombre," ",es.nombre) AS articulo'),'dp.antiguo_precio','dp.nuevo_precio')
			->where('p.fecha_mod','LIKE','%'.$query.'%')
			->orderBy('p.fecha_mod','desc')
			->paginate(20);
	
			return view("deposito.lista.show",["detalle"=>$lista , "searchText"=>$query]);

	}

	public function detalle($id)
	{
		$lista = DB::table('lista_precio as l')
		->select('l.fecha_mod')
		->where('l.idlista_precio','=',$id)
		->first();

		$detalle = DB::table('precio as p')
		->where('p.idlista_precio','=',$id)
		->get();
		return view("deposito.lista.show",["lista"=>$lista, "detalle"=>$detalle]);
	}

}
