<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\RoleDataTable;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function index(RoleDataTable $roleDataTable)
    {
        return $roleDataTable->render('pages.konfigurasi.role');
    }

    public function create()
    {
        return view('pages.konfigurasi.role-form', [
            'data' => new Role(),
            'action' => route('konfigurasi.roles.store'),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'guard_name' => 'required|string',
        ]);

        Role::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Role created successfully',
        ]);
    }

    public function show(Role $role)
    {
        return view('pages.konfigurasi.role-form', [
            'data' => $role,
        ]);
    }

    public function edit(Role $role)
    {
        return view('pages.konfigurasi.role-form', [
            'data' => $role,
            'action' => route('konfigurasi.roles.update', $role->id),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'guard_name' => 'required|string',
        ]);

        $role->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Role updated successfully',
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'status' => 'success', 
            'message' => 'Role deleted successfully'
        ]);
    }
}
