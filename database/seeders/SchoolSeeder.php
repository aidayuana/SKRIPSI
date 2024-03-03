<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $school = School::create([
            'school_name' => 'SMK TELKOM MALANG',
            'address' => 'Jl. Danau Ranau, Sawojajar, Kec. Kedungkandang, Kota Malang'
        ]);
    }
}
