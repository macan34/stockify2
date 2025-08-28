<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
    $roles = Role::all();

    // Kirim data roles ke view create
    return view('users.create', compact('roles'));
    }

    // Menyimpan user baru
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'role_id' => 'required|exists:roles,id', // Validasi role_id
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role_id' => $request->role_id, // Menyimpan role_id
    ]);

    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
}

    // Menampilkan form untuk edit user
    public function edit(User $user)
    { $roles = Role::all();

    return view('users.edit', compact('user', 'roles'));
    }

    // Mengupdate data user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
