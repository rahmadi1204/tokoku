<?php

namespace App\Http\Controllers\Setting;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function seed()
    {
        $roleSuperAdmin = Role::create(['name' => 'super admin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleClient = Role::create(['name' => 'client']);

        $superAdmin = Permission::create(['name' => 'super admin access']);
        $admin = Permission::create(['name' => 'admin access']);
        $client = Permission::create(['name' => 'client access']);

        $userSuperAdmin = User::find(1);
        $userAdmin = User::find(2);

        $userSuperAdmin->assignRole('super admin');
        $userAdmin->assignRole('admin');

        $roleSuperAdmin->givePermissionTo([$superAdmin, $admin, $client]);
        $roleAdmin->givePermissionTo([$admin, $client]);
        $roleClient->givePermissionTo($client);
    }
}
