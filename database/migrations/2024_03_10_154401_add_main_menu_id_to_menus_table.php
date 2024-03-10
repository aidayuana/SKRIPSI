<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMainMenuIdToMenusTable extends Migration
{
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            // Check if the column does not exist before trying to add it
            if (!Schema::hasColumn('menus', 'main_menu_id')) {
                $table->unsignedBigInteger('main_menu_id')->nullable();
                $table->foreign('main_menu_id')->references('id')->on('main_menus')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            // Safely drop the foreign key and column if they exist
            if (Schema::hasColumn('menus', 'main_menu_id')) {
                $table->dropForeign(['main_menu_id']); // Adjust if you have a custom foreign key name
                $table->dropColumn('main_menu_id');
            }
        });
    }
}
