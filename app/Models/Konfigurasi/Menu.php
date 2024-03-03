<?php

namespace App\Models\Konfigurasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'main_menu_id');
    }
}
