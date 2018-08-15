<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;

use vga\Http\Requests;
use vga\Stock;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use vga\Http\Requests\StockFormRequest;
use vga\DetalleStock;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class StockController extends Controller
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
			->select('a.idarticulo','a.codigo','a.nombre','a.stock','c.nombre as categoria','es.nombre as escala')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->where('a.estado','=','Activo')
            ->orWhere('a.codigo','LIKE','%'.$query.'%')
            ->where('a.estado','=','Activo')
            ->orderBy('a.idarticulo','desc')
			->paginate(7);
			return view('deposito.stock.index',["articulos"=>$articulos ,"searchText"=>$query]);
		}
	}

	public function create()
	{
        $articulos = DB::table('articulo as art')
		->join('escala as es','art.idescala','=','es.idescala')
		->select('art.idarticulo', DB::raw('CONCAT(art.nombre," ",art.codigo," ",es.nombre) AS articulo'), 'art.stock' ,'es.nombre as escala')
		->where('art.estado','=','Activo')
		->get();
		return view("deposito.stock.create",["articulos"=>$articulos]);
	}


	public function store(StockFormRequest $request)
	{
		try{
			DB::beginTransaction();
			$stock=new Stock;
			$mytime = Carbon::now('America/Argentina/Salta');
			$stock->fecha = $mytime->toDateTimeString();
			$stock->save();

			$idarticulo = $request->get('idarticulo');
			$antigua_cantidad = $request->get('stock');
			$nueva_cantidad = $request->get('nueva_cantidad');
			$motivo = $request->get('motivo');

			$cont = 0;

			while ($cont<count($idarticulo)) {
				
				$detalle = new DetalleStock;
				$detalle->idstock = $stock->idstock;
				$detalle->idarticulo = $idarticulo[$cont];
				$detalle->antigua_cantidad = $antigua_cantidad[$cont];
				$detalle->nueva_cantidad = $nueva_cantidad[$cont];
				$detalle->motivo = $motivo[$cont];
				$detalle->save();
				$cont = $cont+1;
			}
			DB::commit();
		}	catch(Exception $e){
			DB::rollback();
			}
		return Redirect::to('deposito/stock');
	}

	public function show(Request $request)
	{
		$query = trim($request->get('searchText'));
		$log= DB::table('stock as st')
		->join('detalle_stock as dts','dts.idstock','=','st.idstock')
		->join('articulo as art','art.idarticulo','=','dts.idarticulo')
		->join('escala as es','art.idescala','=','es.idescala')
		->select('st.fecha', DB::raw('CONCAT(art.codigo," ",art.nombre," ",es.nombre) AS articulo'), 'dts.motivo','dts.antigua_cantidad','dts.nueva_cantidad')
		->where('st.fecha','LIKE','%'.$query.'%')
		->orderBy('st.fecha','desc')
		->paginate(20);
		

		return view("deposito.stock.show",["modificaciones"=>$log , "searchText"=>$query]);

	}

	public function edit($id)
	{

	}	

	public function update(StockFormRequest $request, $idarticulo)
	{
		$stock = new Stock;
		$stock->idarticulo = $idarticulo;
		$stock->nuevo_precio = $request->get('nuevo_precio');
		$stock->viejo_precio = $request->get('viejo_precio');
		$stock->save();
		return Redirect::to('deposito/articulo');
	}

	public function destroy($id)
	{
		
	}
}
