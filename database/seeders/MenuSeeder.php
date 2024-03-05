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
         /**
        * @var Menu $mm
        */
        $mm = Menu::firstOrcreate(['url' => 'konfigurasi'],['name' => 'konfigurasi', 'category' => 'MASTER DATA', 'icon' => 'setting']);

        $this->attachMenupermission($mm, ['read'], ['adminsekolah']);

        $sm = $mm->subMenus()->create(['name' => 'Menu', 'url' => $mm->url.'/menu', 'category' => $mm->category]);

        $this->attachMenupermission($sm, ['read', 'create', 'update', 'delete'], ['adminsekolah']);
    }
}
