<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\School;
use App\Models\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Str;

class UserSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $school = School::firstOrCreate([
            'school_name' => 'SMK TELKOM MALANG', // Example data
            // Add other necessary fields as per your School model
        ]);

        $class = Classes::firstOrCreate([
            'class_name' => 'Class 12', // Example data
            'school_id' => $school->id, // Associate with the school
            // Add other necessary fields as per your Class model
        ]);

        
        $users = ['siswa', 'guru', 'adminsekolah', 'superadmin'];
        $default = [
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];

        foreach ($users as $value) {
            User::create([...$default,...[
                'name' => $value,
                'email' => $value.'@gmail.com',
                'school_id' => $school->id,
                'class_id' => $class->id,
                
            ]])->assignRole($value);
        }
        
    }
}
