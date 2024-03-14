<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions for 'menu'
        $readMenuPermission = Permission::create(['name' => 'read konfigurasi/menu']);
        $createMenuPermission = Permission::create(['name' => 'create konfigurasi/menu']);
        $editMenuPermission = Permission::create(['name' => 'edit konfigurasi/menu']);
        $updateMenuPermission = Permission::create(['name' => 'update konfigurasi/menu']);
        $deleteMenuPermission = Permission::create(['name' => 'delete konfigurasi/menu']);
        $sortMenuPermission = Permission::create(['name' => 'sort konfigurasi/menu']);

        // Create permissions for 'roles'
        $readRolesPermission = Permission::create(['name' => 'read konfigurasi/roles']);
        $createRolesPermission = Permission::create(['name' => 'create konfigurasi/roles']);
        $editRolesPermission = Permission::create(['name' => 'edit konfigurasi/roles']);
        $updateRolesPermission = Permission::create(['name' => 'update konfigurasi/roles']);
        $deleteRolesPermission = Permission::create(['name' => 'delete konfigurasi/roles']);
        $sortRolesPermission = Permission::create(['name' => 'sort konfigurasi/roles']);

        // Create roles
        $siswaRole = Role::create(['name' => 'siswa']);
        $guruRole = Role::create(['name' => 'guru']);
        $adminSekolahRole = Role::create(['name' => 'adminsekolah']);
        $superAdminRole = Role::create(['name' => 'superadmin']);

        // Assign permissions to specific roles for 'menu'
        $adminSekolahRole->givePermissionTo($readMenuPermission);
        $adminSekolahRole->givePermissionTo($createMenuPermission);
        $adminSekolahRole->givePermissionTo($editMenuPermission);
        $adminSekolahRole->givePermissionTo($updateMenuPermission);
        $adminSekolahRole->givePermissionTo($deleteMenuPermission);
        $adminSekolahRole->givePermissionTo($sortMenuPermission);
        $adminSekolahRole->givePermissionTo($readRolesPermission);
        $adminSekolahRole->givePermissionTo($createRolesPermission);
        $adminSekolahRole->givePermissionTo($editRolesPermission);
        $adminSekolahRole->givePermissionTo($updateRolesPermission);
        $adminSekolahRole->givePermissionTo($deleteRolesPermission);
        $adminSekolahRole->givePermissionTo($sortRolesPermission);

        // Assign permissions to specific roles for 'roles'
        $superAdminRole->givePermissionTo($readRolesPermission);
        $superAdminRole->givePermissionTo($createRolesPermission);
        $superAdminRole->givePermissionTo($editRolesPermission);
        $superAdminRole->givePermissionTo($updateRolesPermission);
        $superAdminRole->givePermissionTo($deleteRolesPermission);
        $superAdminRole->givePermissionTo($sortRolesPermission);
        $superAdminRole->givePermissionTo($readMenuPermission);
        $superAdminRole->givePermissionTo($createMenuPermission);
        $superAdminRole->givePermissionTo($editMenuPermission);
        $superAdminRole->givePermissionTo($updateMenuPermission);
        $superAdminRole->givePermissionTo($deleteMenuPermission);
        $superAdminRole->givePermissionTo($sortMenuPermission);

        // If you want to give the same 'menu' permissions to all roles, use a loop
        foreach (Role::all() as $role) {
            $role->givePermissionTo($readMenuPermission);
            $role->givePermissionTo($createMenuPermission);
            $role->givePermissionTo($editMenuPermission);
            $role->givePermissionTo($updateMenuPermission);
            $role->givePermissionTo($deleteMenuPermission);
            $role->givePermissionTo($sortMenuPermission);
        }
    }
}
