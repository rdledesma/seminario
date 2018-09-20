<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListaPrecioTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function Crear()
    {
        $this->visit('/deposito/lista/create')
        ->see('Modificación de Lista de Precios')
        ->see('Artículo')
        ->see('Stock')
        ->see('Escala')
        ->see('Precio de Venta')
        ->see('Nuevo Precio')
        ->select('26_20_250_lt', 'pidarticulo')
        ->type('StockArticulo','pstock')
        ->type('EscalaArticulo','pescala')
        ->type('precio_venta','pprecio_venta')
        ->type('nuevo_precio_venta','pnuevo_precio')
        ->press('Guardar');
    }

    public function leer()
    {
        $this->visit('/deposito/lista/showlista')
        ->see('Historial de Modificaciones de Precios')
        ->see('Buscar')
        ->see('Fecha')
        ->see('Articulo')
        ->see('Precio Antiguo')
        ->see('Precio Nuevo');
    }
}
