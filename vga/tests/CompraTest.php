<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompraTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */

    public function Index()
    {
        $this->visit('/compras/ingreso')
        ->see('Listado de Ingresos')
        ->see('Nuevo Ingreso')
        ->see('Buscar')
            ->see('factura')
            ->see('proveedor')
            ->see('fecha')
            ->see('total')
            ->see('estado')
            ->see('Opciones');
    }
    public function Crear()
    {
        $this->visit('/compras/ingreso/create')
        ->see('Nuevo Ingreso')
        ->select('proveedor', 'idproveedor')
        ->type('comprobante','nro_factura')
        ->type('fecha', 'fecha_ingreso')
            ->select('articulo', 'pidarticulo')
            ->type('cantidad', 'pcantidad')
            ->type('precio_compra', 'pprecio_compra')
            ->type('precio_venta', 'pprecio_venta')
            ->click('Agregar')
            ->see('Guardar')
        ->press('Guardar')
        ->seePageIs('/compras/ingreso');
    }
    public function Ver()
    {
        $this->visit('compras/ingreso/10')
        ->see('factura')
        ->see('fecha')
        ->see('estado')
        ->see('proveedor')
            ->see('articulo')
            ->see('cantidad')
            ->see('precio_compra')
            ->see('precio_venta')
            ->see('subtotal');

    }

    public function Cancelar()
    {
        $this->visit('/compras/ingreso')
        ->see('Listado de Ingresos')
        ->see('Nuevo Ingreso')
        ->see('Buscar')
            ->see('factura')
            ->see('proveedor')
            ->see('fecha')
            ->see('total')
            ->see('estado')
            ->see('Opciones')
            ->click('Anular')
            ->see('Confirme si desea cancelar el cancelar ingreso')
            ->see('Cerrar')
            ->press('Confirmar');
    }

    
}
