<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use vga\Http\Requests;
use vga\PagoCtaCorriente;
use vga\Venta;
use vga\Http\Requests\PagoCtaCorrienteFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
class PagoCtaCorrienteController extends Controller
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
            ->select('v.idventa','v.fecha_venta','v.estado','v.total','v.saldo', DB::raw('CONCAT(p.nombre," ",p.numero_documento)AS persona'))
            ->where('p.nombre','LIKE','%'.$query.'%')
			->where('v.tipo_pago','=','Cuenta Corriente')
			->orderBy('v.idventa','desc')
			->paginate(7);
			return view('pagos.corriente.index',["ventas"=>$ventas,"searchText"=>$query]);
		}
	}

	public function create()
	{
	}

	public function store(PagoCtaCorrienteFormRequest $request)
	{
		$pago = new PagoCtaCorriente();
		$pago->idventa = $request->get('idventa');
		$pago->importe = $request->get('importe');
		$pago->paga_con = $request->get('paga_con');
		$pago->vuelto = $request->get('vuelto');
		$mytime = Carbon::now('America/Argentina/Salta');
		$pago->fecha=$mytime->toDateTimeString();
		$pago->saldo = $request->get('saldo')-$request->get('importe'); 
		$pago->save();

		return Redirect::to('/pagos/corriente');
	}

	public function show($id)
	{
            $venta = DB::table('venta as v')
            ->join('persona as p','v.idpersona','=','p.idpersona')
			->select('v.idventa','v.fecha_venta','v.estado','v.total','v.saldo','v.estado', DB::raw('CONCAT(p.nombre," ",p.numero_documento)AS persona'))
			->where('v.idventa','=',$id)
			->first();

			$pagos = DB::table('pago as p')
			->where('p.idventa','=',$id)
			->orderBy('p.fecha' , 'desc')
			->paginate(5);
			return view('pagos.corriente.show',["ven"=>$venta, "pagos"=>$pagos]);
	}

	public function edit($id)
	{

	}	

	

	public function destroy($id)
	{
		$pago = PagoCtaCorriente::findOrFail($id);
		$pago->estado = 'Anulado'; 
		$pago->update();
		return Redirect::to('/pagos/corriente');
	}

	public function crear($id){
		$venta = DB::table('venta')
        ->where('idventa','=',$id)
        ->first();
		return view("pagos.corriente.create", ["venta"=>$venta]);
	}

	public function almacenar(){
		
	}
}
