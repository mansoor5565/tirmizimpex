<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return view('users.create');
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
        $user = UserModel::findOrFail($id);
        return view('users.edit', compact('user'));
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
}
