<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticuloTest extends TestCase
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
        $this->visit('/deposito/articulo/')
        ->see('Listado de Articulos')
        ->click('Nuevo')
        ->seePageIs('/deposito/articulo/create')
        ->see('Nuevo Artículo')
        ->type('CodigoArticulo','codigo')
        ->type('NombreArticulo','nombre')
        ->type('DescripcionArticulo','descripcion')
        ->type('path/imagen','imagen')
        ->select('0' or '1','perecedero')
        ->see('Guardar')
        ->see('Cancelar')
        ->press('Guardar')
        ->seePageIs('/deposito/articulo/')
        ->see('CodigoArticulo')
        ->see('categoria')
        ->see('imagen')
        ->see('Editar')
        ->see('Eliminar');
    }

    public function Leer()
    {
        $this->visit('/deposito/articulo/1/show')
        ->see('Articulo: NombreArticulo')
        ->see('CodigoArticulo')
        ->see('CategoriaArticulo')
        ->see('NombreArticulo')
        ->see('DescripcionArticulo')
        ->see('ImagenArticulo')
        ->see('EscalaArticulo')
        ->see('PerecederoArticulo')
        ->see('Volver');
    }

    public function Actualizar()
    {
        $this->visit('/deposito/articulo/1/edit')
        ->see('Editar Articulo: NombreArticulo')
        ->see('Codigo')
        ->type('CodigoArticulo2', 'codigo')
        ->see('Categoria')
        ->select('CategoriaArticulo2', 'categoria')
        ->see('Nombre')
        ->type('NombreArticulo2', 'nombre')
        ->see('Descripción')
        ->type('DescripcionArticulo2', 'descripcion')
        ->see('Imagen')
        ->select('EscalaArticulo2', 'escala')
        ->select('PerecederoArticulo2', 'perecedero')
        ->see('Cancelar')
        ->press('Guardar')
        ->seePageIs('deposito/articulo')
        ->see('Listado de Articulo')
        ->see('NombreArticulo2')
        ->see('DescripcionArticulo2')
        ->see('Imagen')
        ->see('EscalaArticulo2')
        ->see('PerecederoArticulo2');

    }

    public function Eliminar()
    {
        $this->visit('/deposito/articulo/')
        ->see('Listado de Articulos')
        ->see('1','idarticulo')
        ->see('Eliminar')
        ->click('Eliminar')
        ->see('Eliminar Articulo')
        ->see('Confirme si desea eliminar el articulo')
        ->see('Cerrar')
        ->press('Confirmar')
        ->SeeInDatabase('articulo', ['estado'=>'Inactivo', 'idarticulo' => '1']);
    }
}
