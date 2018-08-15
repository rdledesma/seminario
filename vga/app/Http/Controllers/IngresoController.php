<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;

use vga\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use vga\Http\Requests\IngresoFormRequest;
use vga\Ingreso;
use vga\DetalleIngreso;
use vga\Persona;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;


class IngresoController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        if($request)
        {
            $query = trim($request->get('searchText'));
            $ingresos = DB::table('ingreso as ing')
            ->join('persona as p','ing.idpersona','=','p.idpersona')
            ->select('ing.idingreso', 'ing.nro_factura', 'p.nombre', 'p.numero_documento', 'ing.fecha_ingreso', 'ing.total','ing.estado')
            ->where('ing.nro_factura','LIKE','%'.$query.'%')
            ->orwhere('p.nombre','LIKE','%'.$query.'%')
			->orderBy('ing.idingreso','desc')
			->paginate(7);
			return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }

    public function create()
    {
        $personas = DB::table('persona')
        ->where('estado','=','Activo')
        ->where('tipo_persona','=','Proveedor')
        ->get();
        $articulos = DB::table('articulo as art')
        ->join('escala as esc','esc.idescala','=','art.idescala')
        ->select(DB::raw('CONCAT(art.codigo," ",art.nombre," ",esc.nombre)AS articulo'),'art.idarticulo' , 'art.precio_venta')
        ->where('art.estado','=','Activo')
		->groupBy('articulo','art.idarticulo','art.stock')
        ->get();
        
		return view("compras.ingreso.create",["personas"=>$personas,"articulos"=>$articulos]);
    }

    public function store(IngresoFormRequest $request)
	{
		/*try{*/
			DB::beginTransaction();
            $ingreso=new Ingreso;

			$ingreso->idpersona=$request->get('idproveedor');
			$mytime = Carbon::now('America/Argentina/Salta');
			$ingreso->fecha_registro=$mytime->toDateTimeString();
            $ingreso->fecha_ingreso = $mytime->toDateTimeString($request->get('fecha_ingreso'));
            $ingreso->nro_factura = $request->get('nro_factura');
            $ingreso->total = $request->get('total');
            $ingreso->estado = 'Activo';
			$ingreso->save();



			$idarticulo = $request->get('idarticulo');
			$cantidad = $request->get('cantidad');
			$descuento = $request->get('descuento');
			$precio_venta = $request->get('precio_venta');
            $precio_compra = $request->get('precio_compra');
			$cont = 0;

			while ($cont<count($idarticulo)) {
				
				$detalle = new DetalleIngreso();
				$detalle->idingreso = $ingreso->idingreso;
				$detalle->idarticulo = $idarticulo[$cont];
				$detalle->cantidad = $cantidad[$cont];
				$detalle->precio_compra = $precio_compra[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->subtotal = $detalle->precio_venta*$detalle->cantidad-$detalle->descuento;
				$detalle->save();
				$cont = $cont+1;
			}
            DB::commit();
            

		/*}	catch(Exception $e){
			DB::rollback();
            }*/
            
            
	    	return Redirect::to('compras/ingreso');
	}

    public function show($id)
    {
        $ingreso= DB::table('ingreso as ing')
        ->where('ing.idingreso','=',$id)
		->first();
        
        $persona=DB::table('persona as per')
        ->where('per.idpersona','=',$ingreso->idpersona)
        ->select('per.nombre', 'per.numero_documento', 'per.direccion', 'per.tel', 'per.email')
        ->first();

        $detalle = DB::table('detalle_ingreso as di')
        ->join('articulo as art','di.idarticulo','=','art.idarticulo')
        ->join('escala as esc','esc.idescala','=','art.idescala')
        ->select(DB::raw('CONCAT(art.codigo," ",art.nombre," ",esc.nombre)AS articulo'), 'di.precio_compra','di.precio_venta', 'di.cantidad', 'di.subtotal')
        ->where('di.idingreso','=',$id)
        ->get();

		
		return view("compras.ingreso.show",["ingreso"=>$ingreso, "persona"=>$persona, "detalle"=>$detalle]);
		
    }

    public function destroy($id)
    {
        $ingreso = Ingreso::findOrFail($id);
		$ingreso->Estado = 'Anulado'; 
		$ingreso->update();
		return Redirect::to('compras/ingreso');
    }

    
}
