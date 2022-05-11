<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(UserSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(UnidadesSeeder::class);
        $this->call(ImpuestosSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ProveedoresSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(DescuentosSeeder::class);

    }
}
