<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = UserModel::all();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $groupPermission=$this->groupPermission();
        // dd($groupPermission);
        return view('users.create',['groupPermission' => $groupPermission]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //\
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'profile_image' => 'image|mimes:png|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/user/profile', $imageName); // Store image in storage
        }

        $user = UserModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => $imageName, // Store image path in the user model
        ]);
        $user->syncPermissions($request->permissions);
        $submitSuccess = true;
        return redirect('/users')->with('submitSuccess', $submitSuccess);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $groupPermission=$this->groupPermission();
        $user = UserModel::findOrFail($id);
        $userPermissions = $user->permissions()->pluck('name')->toArray();
        return view('users.edit', ['groupPermission' => $groupPermission, 'user'=>$user,'userPermissions'=>$userPermissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255,email' . $id,
            'password' => 'nullable|string|min:8',
            'profile_image' => 'image|mimes:png|max:2048',
        ]);
        $user = UserModel::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/user/profile', $imageName);
            $user->profile_image = $imageName;
        }

        $user->save();
        $user->syncPermissions($request->permissions);
        return redirect()->route('users.index')->with('updateSuccess', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('DeleteSuccess', 'User deleted successfully!');
    }

    public function groupPermission()
    {
        $permissions = Permission::all();
        $groupedPermissions = [];

        foreach ($permissions as $permission) {
            $prefix = explode('.', $permission->name)[0];

            if (!isset($groupedPermissions[$prefix])) {
                $groupedPermissions[$prefix] = [];
            }

            $groupedPermissions[$prefix][] = $permission;
        }
        return $groupedPermissions;
    }
}
