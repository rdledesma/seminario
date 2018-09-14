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
            ->type('NombreCategoria','nombre')
            ->type('DescripciónDeCategoría', 'descripcion')
            ->press('Guardar')
            ->seePageIs('deposito/categoria')
            ->SeeInDatabase('categoria', ['idcategoria'=>'1', 'nombre' => 'NombreCategoria'])
            ->see('NombreCategoria');
    }


    public function EditarCategoria()
    {   
        $this->visit('deposito/categoria/1/edit')
            ->see('Editar Categoria:NombreCategoria1')
            ->see('Nombre Categoria1')
            ->see('DescripciónDeCategoría1')
            ->type('DescripciónDeCategoría2', 'descripcion')
            ->press('Guardar')
            ->seePageIs('deposito/categoria')
            ->see('Nombre Categoria1')
            ->see('DescripciónDeCategoría2');
    }

    public function EliminarCategoria()
    {
        $this->visit('deposito/categoria/')
            ->see('Categoría')
            ->click('Eliminar')
            ->see('Eliminar Categoria')
            ->click('Confirmar')
            ->SeeInDatabase('categoria', ['condicion'=>'0', 'nombre' => 'Categoria']);

    }


    
    

    
}
