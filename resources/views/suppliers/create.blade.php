@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <!-- Header -->
    <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
        <i class="fas fa-plus-circle text-blue-600 mr-3"></i>Tambah Supplier
    </h1>

    <!-- Error Alert -->
    @if ($errors->any())
    <div class="mb-6 bg-red-100 text-red-800 border-l-4 border-red-500 px-4 py-3 rounded-lg flex items-start">
        <i class="fas fa-exclamation-circle mr-2 mt-1"></i>
        <div>
            <strong class="font-bold">Terjadi Kesalahan:</strong>
            <ul class="mt-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white shadow-lg rounded-2xl border border-gray-100 p-8">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Nama Supplier</label>
                <input type="text" name="name" class="form-input w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       value="{{ old('name') }}" required placeholder="Masukkan nama supplier">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" class="form-input w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('email') }}" placeholder="email@contoh.com">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Telepon</label>
                    <input type="text" name="phone" class="form-input w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('phone') }}" placeholder="08123456789">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Alamat</label>
                <textarea name="address" rows="3" class="form-input w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                          placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
                <a href="{{ route('suppliers.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
