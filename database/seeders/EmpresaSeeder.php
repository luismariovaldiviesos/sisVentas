<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'razonSocial' => 'Khipu Desarrollo de Software',
            'nombreComercial' => 'Khipu Desarrollo de Software',
            'ruc' => '0104649843001',
            'estab' => '001',
            'ptoEmi' => '001',
            'dirMatriz' => 'Dávila Chica y Manuel Moreno',
            'dirEstablecimiento' => 'Dávila Chica y Manuel Moreno',
            'telefono' => '0987308688',
            'email'=> 'khipusistemas@gmail.com',
            'ambiente' => '001',
            'tipoEmision' => '001',
            'contribuyenteEspecial' => 'revisar',
            'obligadoContabilidad' => 'NO',
            'logo' => 'noImage.jpg'
        ]);
    }
}
