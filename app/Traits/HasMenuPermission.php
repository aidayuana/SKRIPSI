<?php

namespace App\Traits;

use App\Models\Konfigurasi\Menu;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

trait HasMenuPermission
{
    public function attachMenupermission(Menu $menu, ?array $permissions, ?array $roles)
    {
        // Fallback to a default set of permissions if none are provided
        $permissions = $permissions ?? ['create', 'read', 'update', 'delete'];

        foreach ($permissions as $item) {
            // Correctly append the menu's URL to the permission name
            $permissionName = $item . '-' . $menu->url;

            // Use findOrCreate to avoid creating duplicates
            $permission = Permission::findOrCreate($permissionName, 'web'); // Assuming 'web' is your guard name

            if ($roles) {
                foreach ($roles as $roleName) {
                    $role = Role::findByName($roleName, 'web');
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
