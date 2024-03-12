<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\MenuDataTable;
use App\Models\Konfigurasi\Menu;
use App\Http\Controllers\Controller;
use App\Http\Requests\Konfigurasi\MenuRequest;
use App\Models\Permission;
use App\Models\User;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Cache;
use Mavinoo\Batch\BatchFacade;
use Illuminate\Support\Facades\Response;

class MenuController extends Controller
{
    public function __construct(private MenuRepository $repository) 
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(MenuDataTable $menuDataTable)
    {   
        $this->authorize('read konfigurasi/menu');
        return $menuDataTable->render('pages.konfigurasi.menu');
    }


    public function sort()
    {
        try {
            $menus = $this->repository->getMenus();
            $data = [];
            $i = 0;
            foreach ($menus as $mm) {
                $i++;
                $data[] = ['id' => $mm->id, 'orders' => $i];
                foreach ($mm->subMenus as $sm) {
                    $i++;
                    $data[] = ['id' => $sm->id, 'orders' => $i];
                }
            }

            Cache::forget('menus');

            BatchFacade::update(new Menu(), $data, 'id');

            return Response::json(['status' => 'success', 'message' => 'Menu sorted successfully'], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Menu $menu)
    {
        $this->authorize('create konfigurasi/menu');
        
        return view('pages.konfigurasi.menu-form', [
            'action' => route('konfigurasi.menu.store'),
            'data' => $menu,
            'mainMenus' => $this->repository->getMainMenus()
        ]);
    }

    private function fillData(MenuRequest $request, Menu $menu)
    {
        $menu->fill($request->validated());
        $menu->fill([
            'orders' => $request->orders,
            'icon' => $request->icon,
            'category' => $request->category,
            'main_menu_id' => $request->main_menu,
        ]);
    }
    
    public function store(MenuRequest $request, Menu $menu)
    {
        DB::beginTransaction();
        try {
            $this->authorize('create konfigurasi/menu');

            $this->fillData($request, $menu);
    
            $menu->save();
    
            foreach($request->permission?? [] as $permission){
                Permission::create(['name' => $permission. "{$menu->url}"])->menus()->attach($menu);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return responseError($th);
        }
       

        return responseSuccess();
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
        $this->authorize('update konfigurasi/menu');
        
        return view('pages.konfigurasi.menu-form', [
            'action' => route('konfigurasi.menu.update', $menu->id),
            'data' => $menu,
            'mainMenus' => $this->repository->getMainMenus()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Menu $menu, MenuRequest $request)
    {
        $this->authorize('update konfigurasi/menu');

        $this->fillData($request, $menu);
        if ($request->level_menu == 'main_menu') {
            $menu->main_menu_id = null;
        }
        $menu->save();

        return responseSuccess(true);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
