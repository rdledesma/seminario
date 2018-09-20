<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PagoCtaCteTest extends TestCase
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
        $this->visit('/pagos/corriente')
        ->see('Ventas de Cuenta Corriente')
        ->see('Nombre y Número')
        ->see('Fecha')
        ->see('Estado')
        ->see('Total')
        ->see('SALDO')
        ->see('Ver')
        ->click('Ver')
            ->seePageIs('/pagos/corriente/12');
    }

    public function show()
    {
        $this->visit('/pagos/corriente/12')
        ->see('venta')
        ->see('fecha')
        ->see('cliente')
        ->see('importe')
        ->see('saldo')
        ->see('estado')
            ->see('fecha de Pago')
            ->see('Monto Pagado')
            ->see('Paga Con')
            ->see('Su vuelto')
            ->see('Opciones sobre Pago');
    }

}

