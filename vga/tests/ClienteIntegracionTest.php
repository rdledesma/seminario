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
                ->type('Dario Ledesma', 'nombre' )
                ->type('DNI', 'tipo_documento')
                ->type('10111011', 'numero_documento' )
                ->type('Av. SiempreViva 123', 'direccion' )
                ->type('154892', 'telefono' )
                ->type('dario@gmail.com', 'email' )
                ->press('Guardar')
            ->seePageIs('ventas/cliente/')
        ->see('Dario Ledesma')
        ->click('Eliminar')
            ->see('Eliminar Cliente')
            ->press('Confirmar')
        ->seePageIs('ventas/cliente')
        ->SeeInDatabase('persona', ['tipo_persona'=>'Inactivo', 'nombre' => 'Dario Ledesma']);

     }
}
