<?php

use App\Http\Controllers\Konfigurasi\MenuController;
use App\Http\Controllers\Konfigurasi\RoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('konfigurasi')->as('konfigurasi.')->group(function () {
        Route::put('menu/sort', [MenuController::class, 'sort'])->name('menu.sort');
        Route::resource('menu', MenuController::class);

        // Define routes for roles, ensuring edit route is properly named
        Route::resource('roles', RoleController::class)->except(['edit']);
        // Specifically define the edit route to ensure it matches expected route naming conventions
        Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    });
});

require __DIR__.'/auth.php';
