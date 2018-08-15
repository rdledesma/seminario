<?php

namespace vga;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //1 declarar a que tabla se hará referencia
    protected $table = 'detalleventa';
    //2 indicar el atributo primary key del modelo
    protected $primaryKey = 'iddetalleventa';

    //para especificar cuando se creó y actualizó el registro
    //se pueden agregar dos columnas automaticamente cambiando a true
    public $timestamps=false;

    //se especifican cuales son los campos que van a recibir un valor para
    //almacenar en la bd, es decir los campos que se asignan al modelo
    protected $fillable = [
    	'idventa',
    	'idarticulo',
    	'precio_venta',
        'cantidad',
        'subtotal'
    ];

    //declaramos cuales son los campos que no se asignan al modelo
    protected $guarded = [];
}
