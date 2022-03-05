<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
        	'nombre' => 'papas fritas',
        	'costo' => 1.00,
        	'precio' => 2.00,
        	'barcode' => '1',
        	'stock' => 25,
        	'alertas' => 20,
        	'categoria_id' => 1
        ]);


        Producto::create([
        	'nombre' => 'café caliente',
        	'costo' => 2.00,
        	'precio' => 2.50,
        	'barcode' => '2',
        	'stock' => 20,
        	'alertas' => 18,
        	'categoria_id' => 2
        ]);
        Producto::create([
        	'nombre' => 'atencion al cliente',
        	'costo' => 5.00,
        	'precio' => 6.00,
        	'barcode' => '3',
        	'stock' => 100,
        	'alertas' => 99,
        	'categoria_id' => 3
        ]);
    }
}
