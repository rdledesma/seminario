<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClienteTest extends TestCase
{   
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    
    public function Eliminar()
    {
        $this->visit('ventas/cliente')
            ->see('Listado de Clientes')
            ->click('Eliminar')
            ->see('Eliminar Cliente')
            ->press('confirmar')
            ->seePageIs('ventas/cliente');
    }

    public function Crear()
    {
        $this->visit('ventas/cliente/create')
            ->see('Nuevo Cliente')
            ->type('Nombre', 'nombre' )
            ->select('DNI' or 'CUIT/CUIL' or 'RUC' or 'PAS', 'tipo_documento')
            ->type('Numero', 'numero_documento' )
            ->type('dir', 'direccion' )
            ->type('tel', 'telefono' )
            ->type('ejemplo@algo', 'email' )
            ->press('Guardar')
            ->seePageIs('ventas/cliente/');
    }

    public function Editar()
    {
        $this->visit('ventas/cliente/update')
            ->see('Nuevo Cliente')
            ->type('Nombre', 'nombre' )
            ->select('DNI' or 'CUIT/CUIL' or 'RUC' or 'PAS', 'tipo_documento')
            ->type('Numero', 'numero_documento' )
            ->type('dir', 'direccion' )
            ->type('tel', 'telefono' )
            ->type('ejemplo@algo', 'email' )
            ->press('Guardar')
            ->seePageIs('ventas/cliente/');
    }
    
    public function Ver()
    {
        $this->seePageIs('ventas/cliente/update')
            ->see('Listado Cliente');
    }
}
