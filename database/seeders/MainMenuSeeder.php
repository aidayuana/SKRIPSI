<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_menus')->insert([
            ['name' => 'Menu Utama 1'],
            ['name' => 'Menu Utama 2'],
            // Tambahkan lebih banyak menu sesuai kebutuhan
        ]);
    }
}
