<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'administrador',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'empleado',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'visitante',
            'guard_name' => 'web',
        ]);


        // permisos categorias

        Permission::create([
            'name' => 'crear_categoria',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_categoria',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_categoria',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_categoria',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_categoria',
            'guard_name' => 'web',
        ]);

        // permisos clinica


        Permission::create([
            'name' => 'ver_empresa',
            'guard_name' => 'web',
        ]);

        Permission::create([
            'name' => 'editar_empresa',
            'guard_name' => 'web',
        ]);

        // permisos impuestos

        Permission::create([
            'name' => 'crear_impuesto',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_impuesto',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_impuesto',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_impuesto',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_impuesto',
            'guard_name' => 'web',
        ]);

         // permisos productos

        Permission::create([
            'name' => 'crear_producto',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_producto',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_producto',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_producto',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_producto',
            'guard_name' => 'web',
        ]);

        // // permisos pacientes

        Permission::create([
            'name' => 'crear_proveedor',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_proveedor',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_proveedor',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_proveedor',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_proveedor',
            'guard_name' => 'web',
        ]);


        //  // permisos ingresos

         Permission::create([
            'name' => 'crear_ingreso',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_ingreso',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_ingreso',
            'guard_name' => 'web',
        ]);

        Permission::create([
            'name' => 'detalle_ingreso',
            'guard_name' => 'web',
        ]);

        //  // permisos egresos

        Permission::create([
            'name' => 'crear_egreso',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_egreso',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_egreso',
            'guard_name' => 'web',
        ]);

        Permission::create([
            'name' => 'detalle_egreso',
            'guard_name' => 'web',
        ]);

        // // permisos clientes

        Permission::create([
            'name' => 'crear_cliente',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_cliente',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_cliente',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_cliente',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_cliente',
            'guard_name' => 'web',
        ]);

         //permisos factura

         Permission::create([

            'name' => 'facturar',
            'guard_name' => 'web'
         ]);

         // permisos unidades de medida

        Permission::create([
            'name' => 'crear_unidad',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_unidad',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_unidad',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_unidad',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_unidad',
            'guard_name' => 'web',
        ]);

        // // pagos extras

        //  Permission::create([
        //     'name' => 'crear_pagoextra',
        //     'guard_name' => 'web',
        // ]);
        // Permission::create([
        //     'name' => 'ver_pagoextra',
        //     'guard_name' => 'web',
        // ]);
        // Permission::create([
        //     'name' => 'buscar_pagoextra',
        //     'guard_name' => 'web',
        // ]);
        // Permission::create([
        //     'name' => 'editar_pagoextra',
        //     'guard_name' => 'web',
        // ]);
        // Permission::create([
        //     'name' => 'eliminar_pagoextra',
        //     'guard_name' => 'web',
        // ]);

        // // roles

        Permission::create([
            'name' => 'crear_rol',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_rol',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_rol',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_rol',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_rol',
            'guard_name' => 'web',
        ]);

        //  // permisos

         Permission::create([
            'name' => 'crear_permiso',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_permiso',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_permiso',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_permiso',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_permiso',
            'guard_name' => 'web',
        ]);

        // //asignar
        Permission::create([
            'name' => 'ver_asignar',
            'guard_name' => 'web',
        ]);




        // //agenda

        // Permission::create([
        //     'name' => 'ver_calendario',
        //     'guard_name' => 'web',
        // ]);

        // //reportes

        // Permission::create([
        //     'name' => 'ver_reporte',
        //     'guard_name' => 'web',
        // ]);

        // // estadisticas

        // Permission::create([
        //     'name' => 'ver_estadistica',
        //     'guard_name' => 'web',
        // ]);






    }
}
