<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Example data array
        $classes = [
            ['class_name' => 'Class 10', 'school_id' => 1],
            ['class_name' => 'Class 11', 'school_id' => 1],
            // Add as many classes as you need
        ];

        // Insert data into the 'classes' table
        foreach ($classes as $class) {
            DB::table('classes')->insert([
                'class_name' => $class['class_name'],
                'school_id' => $class['school_id'] // Ensure this matches an existing 'id' in the 'schools' table
            ]);
        }
    }
}
