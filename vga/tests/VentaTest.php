<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VentaTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    

    public function Ver()
    {
        $this->visit('/ventas/venta/7')
        ->see('idventa')
        ->see('fecha')
        ->see('cliente')
        ->see('tipo_factura')
        ->see('tipo_pago')
        ->see('forma_pago')
        ->see('estado')
            ->see('articulo')
            ->see('cantidad')
            ->see('precio_venta')
            ->see('descuento')
            ->see('subtotal')
        ->see('total')
        ->see('saldo');
    }

    public function Cancelar()
    {
        $this->visit('/ventas/venta')
        ->see('Listado de Ventas')
        ->see('Nueva Venta')
        ->see('Buscar')
        ->see('id')
        ->see('fecha')
        ->see('cliente')
        ->see('estado')
        ->see('factura')
        ->see('total')
        ->see('saldo')
        ->click('Anular')
        ->see('Confirme si desea cancelar la venta seleccionada')
        ->see('Cerrar')
        ->press('Confirmar');
    }

    public function Index()
    {
        $this->visit('/ventas/venta')
        ->see('Listado de Ventas')
        ->see('Nueva Venta')
        ->see('Buscar')
        ->see('id')
        ->see('fecha')
        ->see('cliente')
        ->see('estado')
        ->see('factura')
        ->see('total')
        ->see('saldo')
        ->see('Opciones');
    }

    public function Crear()
    {
        $this->visit('/ventas/venta/create')
        ->see('Nueva Venta')
        ->select('A' or 'B', 'factura')
        ->type('fecha', 'fecha')
        ->select('cliente', 'idcliente')
        ->select('pago' , 'tipo_pago')
        ->select('forma', 'forma_pago')
            ->select('articulo', 'pidarticulo')
            ->see('pstock')
            ->see('pprecio_venta')
            ->type('cantidad', 'pcantidad')
            ->type('descuento', 'descuento')
            ->click('Agregar')
        ->see('Guardar')
        ->seePageIs('/ventas/venta');
    }
}
