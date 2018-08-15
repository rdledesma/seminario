<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(vga\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(vga\Persona::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->name,
        'email' => $faker->safeEmail,
        'direccion' => $faker->text(15),
        'tel' =>str_random(8),
        'numero_documento' =>str_random(8),
        'estado'=>'Activo',
    ];  
});

$factory->define(vga\Categoria::class, function (Faker\Generator $faker) {
    return [
        'nombre' => 'categoría '.$faker->unique()->randomDigit(),
        'descripcion' => $faker->text(45),
        'condicion'=>'1',
    ];  
});

$factory->define(vga\Articulo::class, function (Faker\Generator $faker) {
    return [
        'codigo' => $faker->unique()->randomDigit(),
        'nombre' => 'ariculo '.$faker->unique()->randomDigit(),
        'perecedero'=>'1',
        'idcategoria'=>'26',
        'precio_venta'=> $faker->randomDigit(1,200),
        'descripcion' => $faker->text(45),
        'estado' => 'Activo',
        'idescala' =>'1',
        'stock' => '20',
    ];  
});