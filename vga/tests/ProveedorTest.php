<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProveedorTest extends TestCase
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
        $this->visit('compras/proveedor/create')
            ->see('Nuevo Proveedor')
            ->type('Nombre', 'nombre' )
            ->type('Numero', 'numero_documento' )
            ->type('direccion', 'direccion' )
            ->type('telefono', 'tel' )
            ->type('ejemplo@algo', 'email' )
            ->press('Guardar')
            ->seePageIs('compras/proveedor');
    }

    public function Editar()
    {
        $this->visit('compras/proveedor/1/update')
            ->see('Editar Proveedor: NombreProveedor')
            ->type('Nombre2', 'nombre' )
            ->type('Numero2', 'numero_documento' )
            ->type('dir2', 'direccion' )
            ->type('tel2', 'tel' )
            ->type('ejemplo2@algo', 'email' )
            ->press('Guardar')
            ->seePageIs('compras/proveedor')
            ->see('Nombre2')
            ->see('Numero2', 'numero_documento' )
            ->see('dir2')
            ->see('tel2')
            ->see('ejemplo2@algo');
    }
    
    public function Ver()
    {
        $this->seePageIs('compras/proveedor/')
            ->see('Listado de Proveedores');
    }

    
    public function Eliminar()
    {
        $this->visit('compras/proveedor')
            ->see('Listado de Proveedores')
            ->click('Eliminar')
            ->see('Eliminar Proveedor')
            ->press('confirmar')
            ->seePageIs('compras/proveedor');
    }
}
