<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StockTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */

    public function leer()
    {
        $this->visit('/deposito/stock/show')
        ->see('Historial de Modificaciones de Stock')
        ->see('Buscar')
        ->see('Fecha')
        ->see('Articulo')
        ->see('Antigua Cantidad')
        ->see('Nueva Cantidad')
        ->see('Motivo');
    }

    public function Crear()
    {
        $this->visit('/deposito/stock/create')
        ->see('Nueva Modificación de Stock')
        ->see('Artículo')
        ->see('Stock')
        ->see('Nuevo Stock')
        ->see('Motivo')
        ->see('Agregar')
        ->select('25_10_lt' or '26_20_lt', 'pidarticulo')
        ->type('nuevo_stock','pnuevo_stock')
        ->select('Pérdida' or 'Ruptura' or 'Vencimiento' or 'Otro', 'pmotivo')
        ->press('Agregar')
        ->see('Guardar')
        ->press('Guardar')
        ->seePageIs('/deposito/stock');
    }
}
