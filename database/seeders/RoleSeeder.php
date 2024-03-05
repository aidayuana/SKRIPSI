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
        // Pertama, buat permissions
        $readPermission = Permission::create(['name' => 'read konfigurasi/menu']);
        $createPermission = Permission::create(['name' => 'create konfigurasi/menu']);
        
        // Kemudian, buat roles
        $siswa = Role::create(['name' => 'siswa']);
        $guru = Role::create(['name' => 'guru']);
        $adminSekolah = Role::create(['name' => 'adminsekolah']);
        $superAdmin = Role::create(['name' => 'superadmin']);

        // Lalu, berikan permission ke role tertentu
        $adminSekolah->givePermissionTo($readPermission);
        $adminSekolah->givePermissionTo($createPermission);
        $superAdmin->givePermissionTo($readPermission);
        $superAdmin->givePermissionTo($createPermission);


        // Jika ingin memberikan permission yang sama ke semua role, gunakan looping
        foreach (Role::all() as $role) {
            $role->givePermissionTo($readPermission);
            $role->givePermissionTo($createPermission);
        }
    }
}
