<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'razonsocial' => 'Consumidor Final',
            'tipoidentificacion' => 'RUC',
            'valoridentificacion' => '0101010101001',
            'direccion' => 'dato no disponible',
            'email' => 'nodisponiblre',
            'telefono' => '09999999'
        ]);
        Cliente::create([
            'razonsocial' => 'Juan Perez',
            'tipoidentificacion' => 'RUC',
            'valoridentificacion' => '0101010102001',
            'direccion' => 'dato no disponible',
            'email' => 'clienteuno@gmail.com',
            'telefono' => '09999999'
        ]);

        Cliente::create([
            'razonsocial' => 'Pedro Guerra',
            'tipoidentificacion' => 'RUC',
            'valoridentificacion' => '0101010103001',
            'direccion' => 'dato no disponible',
            'email' => 'clientedos@gmail.com',
            'telefono' => '09999999'
        ]);

        Cliente::create([
            'razonsocial' => 'Joaquin Sabina',
            'tipoidentificacion' => 'RUC',
            'valoridentificacion' => '0101010104001',
            'direccion' => 'dato no disponible',
            'email' => 'clientetres@gmail.com',
            'telefono' => '09999999'
        ]);
    }
}
