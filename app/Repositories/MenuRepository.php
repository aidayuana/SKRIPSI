<?php 

namespace App\Repositories;

use App\Models\Konfigurasi\Menu;

class MenuRepository
{
    public function getMainMenus()
    {
        return Menu::whereNull('main_menu_id')->select('id', 'name')->get()
        ->flatMap(function($item) {
            return [$item->name => $item->id];
        });
    }
}

?>