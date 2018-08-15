<?php

namespace vga\Http\Controllers;

use Illuminate\Http\Request;

use vga\Http\Requests;

use Artiuclo;
use Categoria;

class ReporteController extends Controller
{
    public function getIndex()
    {
        return view('deposito.articulo.reporte');
    }

    public function pdf()
    {
        
    }
}
