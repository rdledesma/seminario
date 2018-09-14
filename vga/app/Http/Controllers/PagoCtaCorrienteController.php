<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;


use vga\Http\Requests;
use vga\PagoCtaCorriente;
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
			->where('v.estado','!=','Anulado')
			->orderBy('v.idventa','desc')
			->paginate(7);
			return view('pagos.corriente.index',["ventas"=>$ventas,"searchText"=>$query]);
		}
	}

	public function create()
	{
		
	}

	public function store(ArticuloFormRequest $request)
	{
		
	}

	public function show($id)
	{
            $venta = DB::table('venta as v')
            ->join('persona as p','v.idpersona','=','p.idpersona')
			->select('v.idventa','v.fecha_venta','v.estado','v.total','v.saldo', DB::raw('CONCAT(p.nombre," ",p.numero_documento)AS persona'))
			->where('v.idventa','=',$id)
			->first();

			$pagos = DB::table('pago as p')
			->where('p.idventa','=',$id)
			->paginate(5);
			return view('pagos.corriente.show',["venta"=>$venta, "pagos"=>$pagos]);
	}

	public function edit($id)
	{

	}	

	public function update(ArticuloFormRequest $request, $id)
	{

	}

	public function destroy($id)
	{

	}

}
