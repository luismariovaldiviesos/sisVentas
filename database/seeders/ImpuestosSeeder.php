<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Impuesto;

class ImpuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Impuesto::create([
            'nombre' => 'IVA',
            'porcentaje' => '0.00',
            'codigo' => '2'
        ]);
        Impuesto::create([
            'nombre' => 'IVA',
            'porcentaje' => '12',
            'codigo' => '2'
        ]);
        Impuesto::create([
            'nombre' => 'IVA',
            'porcentaje' => '14',
            'codigo' => '2'
        ]);
        Impuesto::create([
            'nombre' => 'ICE',
            'porcentaje' => '16',
            'codigo' => '2'
        ]);


    }
}
