<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriaTest extends TestCase
{   use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    
    public function RegistrarCategoria()
    {
        $this->visit('deposito/categoria/create')
            ->see('Nueva Categoria')
            ->type('Aerosol','nombre')
            ->type('Todos los aerosoles', 'descripcion')
            ->press('Guardar')
            ->seePageIs('deposito/categoria')
            ->SeeInDatabase('categoria', ['idcategoria'=>'26', 'nombre' => 'categoría 1'])
            ->see('categoría 1');
    }


    public function EditarCategoria()
    {   
        $this->visit('deposito/categoria/1/edit')
            ->see('Editar Categoria:Aerosol')
            ->see('Aerosol')
            ->see('Todos los aerosoles')
            ->type('Aerosoles tipo común', 'descripcion')
            ->press('Guardar')
            ->seePageIs('deposito/categoria')
            ->see('a')
            ->see('Aerosoles tipo común');
    }

    public function EliminarCategoria()
    {
        $this->visit('deposito/categoria/')
            ->see('Aerosol')
            ->click('Eliminar')
            ->see('Eliminar Categoria')
            ->click('Confirmar')
            ->SeeInDatabase('categoria', ['condicion'=>'0', 'nombre' => 'Aerosol']);
    }


    
    

    
}
