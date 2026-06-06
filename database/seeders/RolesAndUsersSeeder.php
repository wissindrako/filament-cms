<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'admin'    => 'Administrador con acceso total',
            'approver' => 'Puede revisar y publicar contenido',
            'editor'   => 'Puede crear y editar contenido',
        ];

        foreach ($roles as $name => $description) {
            Role::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        $users = [
            [
                'name'     => 'Admin',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('admin123'),
                'role'     => 'admin',
            ],
            [
                'name'     => 'Aprobador',
                'email'    => 'approver@admin.com',
                'password' => bcrypt('approver123'),
                'role'     => 'approver',
            ],
            [
                'name'     => 'Editor',
                'email'    => 'editor@admin.com',
                'password' => bcrypt('editor123'),
                'role'     => 'editor',
            ],
        ];

        foreach ($users as $data) {
            $role = $data['role'];
            unset($data['role']);

            $user = User::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
            $user->syncRoles([$role]);
        }
    }
}
