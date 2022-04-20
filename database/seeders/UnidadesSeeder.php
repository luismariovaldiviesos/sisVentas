<?php

namespace Database\Seeders;

use App\Models\Unidades;
use Illuminate\Database\Seeder;

class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidades::create([
            'nombre' => 'unidad'
        ]);

        Unidades::create([
            'nombre' => 'kilo'
        ]);
    }
}
