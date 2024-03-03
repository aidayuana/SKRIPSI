<?php

namespace Database\Seeders;

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
        Role::create(['name' => 'siswa']);
        Role::create(['name' => 'guru']);
        Role::create(['name' => 'admin sekolah']);
        Role::create(['name' => 'super admin']);
    }
}
