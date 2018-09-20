<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('pagos/corriente/create/{idventa}','PagoCtaCorrienteController@crear');
Route::post('pagos/corriente/create/{idventa}','PagoCtaCorrienteController@store');

Route::get('deposito/lista/show/{idlista_precio}', 'PrecioController@detalle');
Route::get('deposito/articulo/reporte', 'ArticuloController@reporte');

Route::get('ventas/venta/facturaA/{idventa}', 'VentaController@imprimir');

Route::resource('deposito/categoria','CategoriaController');   
Route::resource('deposito/articulo','ArticuloController');
Route::resource('deposito/stock','StockController');
Route::resource('deposito/escala','EscalaController');
Route::resource('deposito/lista','PrecioController');


Route::resource('compras/proveedor','ProveedorController');
Route::resource('compras/ingreso','IngresoController');

Route::resource('ventas/cliente','ClienteController');
Route::resource('ventas/venta','VentaController');

Route::resource('pagos/corriente','PagoCtaCorrienteController');

Route::auth();

Route::get('/home', 'HomeController@index');
