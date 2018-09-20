<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;
use vga\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use vga\Http\Requests\VentaFormRequest;
use vga\Venta;
use vga\DetalleVenta;
use vga\Persona;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Mpdf\Mpdf;

use vga\Articulo;

use Dompdf\Dompdf;

use Barryvdh\DomPDF\Facade as PDF;

class VentaController extends Controller 
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        if($request)
        {
            $query = trim($request->get('searchText'));
            $ventas = DB::table('venta as v')
            ->join('persona as p','v.idpersona','=','p.idpersona')
            ->select('v.idventa','v.fecha_venta', 'v.total', 'v.descuento', 'v.estado', 'p.nombre', 'v.saldo', 'v.factura')
            ->where('v.idventa','LIKE','%'.$query.'%')
            ->orwhere('p.nombre','LIKE','%'.$query.'%')
			->orderBy('v.idventa','desc')
			->paginate(7);
			return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
        }
    }

    public function create()
    {
        $personas = DB::table('persona')
        ->where('Estado','=','Activo')
        ->get();
        $articulos = DB::table('articulo as art')
        ->select(DB::raw('CONCAT(art.codigo," ",art.nombre)AS articulo'),'art.idarticulo','art.stock','art.precio_venta')
        ->where('art.estado','=','Activo')
		/*->where('art.stock','>','0')*/
		->groupBy('articulo','art.idarticulo','art.stock')
        ->get();
        $detalle = [];
		return view("ventas.venta.create2",["personas"=>$personas,"articulos"=>$articulos, "detalle"=>$detalle]);
    }

    public function store(VentaFormRequest $request)
	{
		/*try{*/
			DB::beginTransaction();
            $venta=new Venta;
			$venta->idpersona=$request->get('idcliente');
			$venta->total=$request->get('total_venta');
			$mytime = Carbon::now('America/Argentina/Salta');
			$venta->fecha_registro=$mytime->toDateTimeString();
            $venta->tipo_pago = $request->get('tipo_pago');
            $venta->factura = $request->get('factura');
            $venta->descuento = 0;
            $venta->forma_pago = $request->get('forma_pago');
            $venta->fecha_venta = $mytime->toDateTimeString($request->get('fecha'));
            $venta->precioventatotal = $request->get('totalventa');
            $venta->total = $request->get('total');
            if ($request->get('factura') == 'A')
            {
                $venta->descuento = 1.21;
            }

            if ($request->get('tipo_pago') == 'Contado')
            {
                $venta->saldo = 0;
                $venta->estado ='Pagado';
            }
            elseif($request->get('tipo_pago') == 'Cuenta Corriente')
            {
                $venta->saldo = $venta->total;
                $venta->estado ='Deuda';
            }
            
			$venta->save();

			$idarticulo = $request->get('idarticulo');
			$cantidad = $request->get('cantidad');
			$descuento = $request->get('descuento');
			$precio_venta = $request->get('precio_venta');

			$cont = 0;

			while ($cont<count($idarticulo)) {
				
				$detalle = new DetalleVenta();
				$detalle->idventa = $venta->idventa;
				$detalle->idarticulo = $idarticulo[$cont];
				$detalle->cantidad = $cantidad[$cont];
				$detalle->descuento = $descuento[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->subtotal = $detalle->precio_venta*$detalle->cantidad-$detalle->descuento;
				$detalle->save();
				$cont = $cont+1;
			}
            DB::commit();
            

		/*}	catch(Exception $e){
			DB::rollback();
            }*/
            
            
	    	return Redirect::to('ventas/venta');
	}

    public function show($id)
    {
        $venta= DB::table('venta as v')
        ->where('v.idventa','=',$id)
		->first();
        
        $persona=DB::table('persona as per')
        ->where('per.idpersona','=',$venta->idpersona)
        ->select('per.nombre')
        ->first();

        $detalle = DB::table('detalleventa as dv')
        ->join('articulo as a','dv.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo', 'dv.precio_venta', 'dv.cantidad', 'dv.subtotal', 'dv.descuento')
        ->where('dv.idventa','=',$id)
        ->get();

		
		return view("ventas.venta.show",["venta"=>$venta, "persona"=>$persona, "detalle"=>$detalle]);
		
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
		$venta->estado = 'Anulado'; 
		$venta->update();
		return Redirect::to('ventas/venta');
    }

    public function imprimir($id)
    {
        
        $venta= DB::table('venta as v')
        ->where('v.idventa','=',$id)
		->first();
        
        $persona=DB::table('persona as per')
        ->where('per.idpersona','=',$venta->idpersona)
        ->first();

        $detalle = DB::table('detalleventa as dv')
        ->join('articulo as a','dv.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo', 'dv.precio_venta', 'dv.cantidad', 'dv.subtotal', 'dv.descuento')
        ->where('dv.idventa','=',$id)
        ->get();

		
		return view("ventas.venta.facturaA",["venta"=>$venta, "persona"=>$persona, "detalle"=>$detalle]);

            /*$pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('ventas/venta/facturaA', ['persona' => $persona[0]]);
            $aux = ".pdf";
            return $pdf->stream((string)$id.' '.$aux, 1);
            */
            return view("ventas.venta.facturaA", ["persona" => $persona, "detalle"=>$detalle]);

        
    }
}
