@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800"><i class="fas fa-user-edit me-2"></i>Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nama User</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="mt-1 block w-full border rounded-lg px-3 py-2 @error('name') border-red-500 @enderror" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="mt-1 block w-full border rounded-lg px-3 py-2 @error('email') border-red-500 @enderror" required>
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Password Baru (opsional)</label>
            <input type="password" name="password"
                class="mt-1 block w-full border rounded-lg px-3 py-2 @error('password') border-red-500 @enderror"
                placeholder="Kosongkan jika tidak ingin mengubah">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="mt-1 block w-full border rounded-lg px-3 py-2"
                placeholder="Konfirmasi password baru">
        </div>

        <!-- Role -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role_id"
                class="mt-1 block w-full border rounded-lg px-3 py-2 @error('role_id') border-red-500 @enderror">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            @error('role_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center space-x-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                <i class="fas fa-save me-2"></i>Update User
            </button>
            <a href="{{ route('users.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">
                <i class="fas fa-times me-2"></i>Batal
            </a>
        </div>
    </form>
</div>
@endsection
