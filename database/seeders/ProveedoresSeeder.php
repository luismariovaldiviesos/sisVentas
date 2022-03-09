<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedor::create([
            'nombre'=> 'Ingesa',
            'ruc' => '0104649843001',
            'email' => 'ingesan@mail.com',
            'direccion' => 'cuenca',
            'telefono' => '22814955'

        ]);

        Proveedor::create([
            'nombre'=> 'Zhumir',
            'ruc' => '0104641234001',
            'email' => 'zhumir@mail.com',
            'direccion' => 'cuenca',
            'telefono' => '22814955'

        ]);

        Proveedor::create([
            'nombre'=> 'tabaco SA',
            'ruc' => '0104647894001',
            'email' => 'tabaco@mail.com',
            'direccion' => 'cuenca',
            'telefono' => '22814955'

        ]);
    }
}
