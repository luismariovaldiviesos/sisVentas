<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'Comestibles'
        ]);

        Categoria::create([
            'nombre' => 'Bebidas'
        ]);

        Categoria::create([
            'nombre' => 'Servicios'
        ]);
    }
}
