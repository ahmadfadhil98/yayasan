<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $super_admin_permission = Permission::all();

        $admin_permission = $super_admin_permission->filter(function ($permission) {
            return substr($permission->title, 0, 6) == 'admin_';
        });

        Role::findOrFail(1)->permissions()->sync($admin_permission);
    }
}
