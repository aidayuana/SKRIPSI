<?php

namespace Database\Seeders;

use App\Models\Konfigurasi\Menu;
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
        // DB::table('main_menus')->insert([
        //     ['name' => 'Menu Utama 1'],
        //     ['name' => 'Menu Utama 2'],
        //     // Tambahkan lebih banyak menu sesuai kebutuhan
        // ]);

        Menu::firstOrCreate(['url' => 'konfigurasi'], [
            'name' => 'Konfigurasi',
            'category' => 'KONFIGURASI',
            'icon' => 'settings',
            // asumsikan kolom `main_menu_id` null menandakan menu utama
            'main_menu_id' => null 
        ]);

        Menu::firstOrCreate(['url' => 'master-data'], [
            'name' => 'Master Data',
            'category' => 'MASTER DATA',
            'icon' => 'book',
            'main_menu_id' => null
        ]);
    }
}
