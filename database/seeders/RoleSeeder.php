<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         //creación de usuarios
         User::create([
            'name'=> 'Luis Mario',
            'ci' => '0104649843',
            'phone' => '2255181',
            'email' => 'admin@mail.com',
            'profile' => 'administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('administrador')
        ]);
        User::create([
            'name'=> 'ximena chhocho',
            'ci' => '0103844494',
            'phone' => '2255181',
            'email' => 'ximena@mail.com',
            'profile' => 'empleado',
            'status' => 'ACTIVE',
            'password' => bcrypt('empleado')
        ]);

         //creación de roles
         $admin    = Role::create(['name' => 'administrador']);
         $empleado = Role::create(['name' => 'empleado']);





         //creación de permisos:
          //categorias
        Permission::create(['name' => 'crear_categoria',
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

        // permisos empresa

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
        Permission::create([
            'name' => 'importar_producto',
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
         //  // descuentos

         Permission::create([
            'name' => 'crear_descuento',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_descuento',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_descuento',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_descuento',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_descuento',
            'guard_name' => 'web',
        ]);


         //asignar permisos al role Admin

         $admin->givePermissionTo([

            'crear_categoria',
            'ver_categoria',
            'buscar_categoria',
            'editar_categoria',
            'eliminar_categoria',

            //empresa
            'ver_empresa',
            'editar_empresa',

            //impuestos
            'crear_impuesto',
            'ver_impuesto',
            'buscar_impuesto',
            'editar_impuesto',
            'eliminar_impuesto',



            //productos
            'crear_producto',
            'ver_producto',
            'buscar_producto',
            'editar_producto',
            'eliminar_producto',
            'importar_producto',

            //proveedror
            'crear_proveedor',
            'ver_proveedor',
            'buscar_proveedor',
            'editar_proveedor',
            'eliminar_proveedor',

            //ingreso
            'crear_ingreso',
            'ver_ingreso',
            'buscar_ingreso',
            'detalle_ingreso',

            //egreso
            'crear_egreso',
            'ver_egreso',
            'buscar_egreso',
            'detalle_egreso',

            //cliente
            'crear_cliente',
            'ver_cliente',
            'buscar_cliente',
            'editar_cliente',
            'eliminar_cliente',

            //factura
            'facturar',

            // unidad de medida
            'crear_unidad',
            'ver_unidad',
            'buscar_unidad',
            'editar_unidad',
            'eliminar_unidad',

            //roles
            'crear_rol',
            'ver_rol',
            'buscar_rol',
            'editar_rol',
            'eliminar_rol',

               //permisos
               'crear_permiso',
               'ver_permiso',
               'buscar_permiso',
               'editar_permiso',
               'eliminar_permiso',

               //asignar permiso
               'ver_asignar',


                //descuentos
            'crear_descuento',
            'ver_descuento',
            'buscar_descuento',
            'editar_descuento',
            'eliminar_descuento',

         ]);

          //asignar permisos al role Employee
        $empleado->givePermissionTo([
        //cliente
         'crear_cliente',
         'ver_cliente',
         'buscar_cliente',
         'editar_cliente',
         'eliminar_cliente',

         //factura
         'facturar',
        ]);

         //asignar rol al usuario admin
         $uAdmin = User::find(1);
         $uAdmin->assignRole('administrador');

         //asignar rol al usuario empleado
         $uEmpleado = User::find(2);
         $uEmpleado->assignRole('empleado');












    }
}
