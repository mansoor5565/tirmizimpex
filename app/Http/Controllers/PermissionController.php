<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permissions = Permission::all();
        return view('permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
                'name' => 'required|unique:permissions',
            ]);
        Permission::create(['name'=>$request->name]);
        $submitSuccess = true;
        return redirect()->route('permissions.index')->with('submitSuccess', $submitSuccess);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $permission=Permission::findById($id);
        return view('permissions.edit',['permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|unique:permissions,name,'. $id,
        ]);
        $permission=Permission::findById($id);
        $permission->name=$request->name;
        $permission->save();
        $updateSuccess = true;
        return redirect()->route('permissions.index')->with('updateSuccess', $updateSuccess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $permission=Permission::findById($id);
        $permission->delete();
        $DeleteSuccess = true;
        return redirect()->route('permissions.index')->with('DeleteSuccess', $DeleteSuccess);
    }
}
