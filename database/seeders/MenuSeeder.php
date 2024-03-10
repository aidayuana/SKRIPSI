<?php

namespace Database\Seeders;

use App\Models\Konfigurasi\Menu;
use App\Models\Permission;
use App\Traits\HasMenuPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    use HasMenuPermission;
   
    public function run(): void
    {
        // Menambahkan menu 'Konfigurasi' jika belum ada
        $konfigurasiMenu = Menu::firstOrCreate(
            ['url' => 'konfigurasi'],
            ['name' => 'Konfigurasi', 'category' => 'MASTER DATA', 'icon' => 'settings']
        );
        // Menambahkan permissions ke menu 'Konfigurasi'
        $this->attachMenupermission($konfigurasiMenu, ['read'], ['adminsekolah']);

        // Menambahkan submenu 'Menu' dan 'Users' ke dalam 'Konfigurasi'
        $subMenus = [
            ['name' => 'Menu', 'url' => 'konfigurasi/menu'],
            ['name' => 'Users', 'url' => 'konfigurasi/users']
        ];

        foreach ($subMenus as $subMenu) {
            $sm = $konfigurasiMenu->subMenus()->firstOrCreate([
                'url' => $subMenu['url']
            ],[
                'name' => $subMenu['name'], 
                'category' => $konfigurasiMenu->category,
                'main_menu_id' => $konfigurasiMenu->id
            ]);
            $this->attachMenupermission($sm, ['read', 'create', 'update', 'delete'], ['adminsekolah']);
        }

        // Menambahkan menu 'Master Data' jika belum ada
        $masterDataMenu = Menu::firstOrCreate(
            ['url' => 'master-data'],
            ['name' => 'Master Data', 'category' => 'MASTER DATA', 'icon' => 'book']
        );
        // Menambahkan permissions ke menu 'Master Data'
        $this->attachMenupermission($masterDataMenu, ['read'], ['adminsekolah']);

        // Menambahkan submenu 'Tags' ke dalam 'Master Data'
        $sm = $masterDataMenu->subMenus()->firstOrCreate([
            'url' => 'master-data/tags'
        ],[
            'name' => 'Tags', 
            'category' => $masterDataMenu->category,
            'main_menu_id' => $masterDataMenu->id
        ]);
        $this->attachMenupermission($sm, ['read', 'create', 'update', 'delete'], ['adminsekolah']);


        $masterDataMenu = Menu::firstOrCreate(
            ['url' => 'articles'],
            ['name' => 'Articles', 'category' => 'CONTENT', 'icon' => 'book']
        );
        // Menambahkan permissions ke menu 'Master Data'
        $this->attachMenupermission($masterDataMenu, ['read'], ['adminsekolah']);
    }
}