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
        Permission::create(['name' => 'read konfigurasi/menu']);
        
        // Kemudian, buat roles
        $siswa = Role::create(['name' => 'siswa']);
        $guru = Role::create(['name' => 'guru']);
        $adminSekolah = Role::create(['name' => 'admin sekolah']);
        $superAdmin = Role::create(['name' => 'super admin']);

        // Lalu, berikan permission ke role tertentu
        $adminSekolah->givePermissionTo('read konfigurasi/menu');
        $superAdmin->givePermissionTo('read konfigurasi/menu');

        // Jika ingin memberikan permission yang sama ke semua role, gunakan looping
        foreach (Role::all() as $role) {
            $role->givePermissionTo('read konfigurasi/menu');
        }
    }
}
