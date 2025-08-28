@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-md p-6 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Konfirmasi Barang Masuk</h2>

    <div class="mb-4">
        <p class="text-gray-700">Produk: 
            <span class="font-semibold text-blue-600">{{ $task->product->name }}</span>
        </p>
        <p class="text-gray-700">Jumlah: 
            <span class="font-semibold text-blue-600">{{ $task->quantity }}</span>
        </p>
    </div>

    <div class="flex flex-col gap-3">
        {{-- Tombol Sesuai --}}
        <form action="{{ route('staff.incoming.confirm.process', $task->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="approved">
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                ✅ Sesuai (Konfirmasi)
            </button>
        </form>

        {{-- Tombol Tidak Sesuai --}}
        <form action="{{ route('staff.incoming.confirm.process', $task->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="rejected">
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                ❌ Tidak Sesuai
            </button>
        </form>
    </div>
</div>
@endsection
