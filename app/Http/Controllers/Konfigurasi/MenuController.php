<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\MenuDataTable;
use App\Models\Konfigurasi\Menu;
use App\Http\Controllers\Controller;
use App\Http\Requests\Konfigurasi\MenuRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MenuDataTable $menuDataTable)
    {   
        // $this->authorize('read menu');
        $this->authorize('read konfigurasi/menu');
        return $menuDataTable->render('pages.konfigurasi.menu');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Menu $menu)
    {
        return view('pages.konfigurasi.menu-form', [
            'action' => route('konfigurasi.menu.store'),
            'data' => $menu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request, Menu $menu)
    {
        $menu->fill($request->validated());
        $menu->fill([
            'orders' => $request->orders,
            'icon' => $request->icon,
            'category' => $request->category,
        ]);

        $menu->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Create data successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}