<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EscalaTest extends TestCase
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
        $this->visit('/deposito/escala/')
        ->see('Listado de Escalas o Unidades Medida')
        ->click('Nuevo')
        ->see('Nueva Escala o Unidad de Medida')
        ->see('Nombre')
        ->type('NombreEscala', 'nombre')
        ->type('DescripcionEscala', 'descripcion')
        ->see('Descripción');
    }

    public function Leer()
    {
        $this->visit('/deposito/escala/')
        ->see('Listado de Escalas o Unidades Medida')
        ->see('Nuevo')
        ->see('Buscar')
        ->see('ID')
        ->see('Nombre')
        ->see('Descripción')
        ->see('Opciones')
        ->see('Editar')
        ->see('Eliminar');
    }

    public function Actualizar()
    {
        $this->visit('/deposito/escala/1/edit')
        ->see('Editar Escala: NombreEscala')
        ->see('Nombre')
        ->see('NombreEscala')
        ->see('Descripción')
        ->see('DescripciónEscala')
        ->type('NombreEscala2','nombre')
        ->type('DescripcionEscala2','descripcion')
        ->see('Guardar')
        ->see('Restaurar')
        ->see('Cancelar')
        ->press('Guardar')
        ->seePageIs('deposito/escala')
        ->see('Listado de Escalas o Unidades Medida')
        ->see('NombreEscala2')
        ->see('DescripcionEscala2');
    }

    public function Eliminar()
    {
        $this->visit('/deposito/escala/')
        ->see('Listado de Escalas o Unidades Medida')
        ->see('1','idescala')
        ->see('Eliminar')
        ->click('Eliminar')
        ->see('Confirme si desea eliminar la escala registrada')
        ->see('Cerrar')
        ->press('confirmar')
        ->SeeInDatabase('escala', ['estado'=>'Desactivada', 'idescala' => '1']);

    }

}
