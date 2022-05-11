<?php

namespace Database\Seeders;

use App\Models\Descuento;
use Illuminate\Database\Seeder;

class DescuentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Descuento::create([
            'porcentaje' => 0
        ]);
        Descuento::create([
            'porcentaje' => 5
        ]);
        Descuento::create([
            'porcentaje' => 10
        ]);
        Descuento::create([
            'porcentaje' => 15
        ]);
    }
}
