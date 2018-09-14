<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClienteIntegracionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    
     function Integracion()
     {
        $this->visit('ventas/cliente')
        ->see('Listado de Clientes')
        ->see('Nuevo')
        ->see('Editar')
        ->see('Eliminar')
        ->click('Nuevo')
            ->visit('ventas/cliente/create')
            ->see('Nuevo Cliente')
                ->type('José Matorras', 'nombre' )
                ->type('30125068', 'numero_documento' )
                ->type('Av. SiempreViva 123', 'direccion' )
                ->type('4253822', 'telefono' )
                ->press('Guardar')
            ->seePageIs('ventas/cliente/')
        ->see('José Matorras')
        ->click('Eliminar')
            ->see('Eliminar Cliente')
            ->press('Confirmar')
        ->seePageIs('ventas/cliente')
        ->SeeInDatabase('persona', ['estado'=>'Inactivo', 'nombre' => 'José Matorras']);

     }
}
