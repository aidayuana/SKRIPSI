<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_menu_id')->nullable();
            $table->string('name');
            $table->string('url');
            $table->string('category')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('active')->default(1);
            $table->integer('orders')->default(0);
            $table->timestamps();

            $table->foreign('main_menu_id')->references('id')->on('menus')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
