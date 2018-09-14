<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Articulo2Test extends TestCase
{   use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    
    public function AsociarEscala()
    {
        $this->visit('deposito/articulo/')
            ->see('Listado de Articulos')
            ->see('0001')
            ->click('Editar')
            ->see('Antioxido Sinteplast')
            ->see('Escala')
            ->press('Guardar')
            ->seePageIs('deposito/articulo')
            ->see('0001')
            ->see('Antioxido Sinteplast')
            ->see('lt');
    }

    
}
