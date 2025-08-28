@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah User Baru</h1>

    {{-- Menampilkan pesan sukses (jika ada) --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Menampilkan pesan error umum --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            <ul class="text-sm pl-5 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form untuk menambah user --}}
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" id="name"
                value="{{ old('name') }}"
                class="mt-1 block w-full border rounded-lg px-3 py-2 @error('name') border-red-500 @enderror" required>
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email"
                value="{{ old('email') }}"
                class="mt-1 block w-full border rounded-lg px-3 py-2 @error('email') border-red-500 @enderror" required>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label for="role_id" class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role_id" id="role_id"
                class="mt-1 block w-full border rounded-lg px-3 py-2 @error('role_id') border-red-500 @enderror" required>
                <option value="">-- Pilih Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password"
                class="mt-1 block w-full border rounded-lg px-3 py-2 @error('password') border-red-500 @enderror" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="mt-1 block w-full border rounded-lg px-3 py-2" required>
        </div>

        <!-- Tombol -->
        <div class="flex items-center space-x-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Simpan
            </button>
            <a href="{{ route('users.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
