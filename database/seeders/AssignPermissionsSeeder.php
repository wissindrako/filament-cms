<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::findByName('admin');
        $admin->syncPermissions(Permission::all());

        $editor = Role::findByName('editor');
        $editor->syncPermissions(Permission::whereIn('name', [
            'view_service', 'view_any_service', 'create_service', 'update_service',
            'view_project', 'view_any_project', 'create_project', 'update_project',
            'view_testimonial', 'view_any_testimonial', 'create_testimonial', 'update_testimonial',
        ])->get());

        $approver = Role::findByName('approver');
        $approver->syncPermissions(Permission::whereIn('name', [
            'view_service', 'view_any_service', 'update_service',
            'view_project', 'view_any_project', 'update_project',
            'view_testimonial', 'view_any_testimonial', 'update_testimonial',
            'page_SiteSettings',
        ])->get());
    }
}
