@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-md p-6 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Konfirmasi Barang Keluar</h2>

    <div class="mb-4">
        <p class="text-gray-700">Produk: <span class="font-semibold text-blue-600">{{ $task->product->name }}</span></p>
        <p class="text-gray-700">Jumlah: <span class="font-semibold text-blue-600">{{ $task->quantity }}</span></p>
    </div>

    <form action="{{ route('staff.outgoing.confirm.process', $task->id) }}" method="POST" class="space-y-4">
        @csrf

        <div class="flex flex-col gap-2">
            <label class="inline-flex items-center">
                <input type="radio" name="status" value="confirmed" required class="text-blue-600 focus:ring-blue-500">
                <span class="ml-2 text-gray-700">✅ Sesuai (Konfirmasi Barang Siap)</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" name="status" value="issue" required class="text-red-600 focus:ring-red-500">
                <span class="ml-2 text-gray-700">❌ Tidak Sesuai (Catatan)</span>
            </label>
        </div>

        <div>
            <label for="note" class="block text-gray-700 font-medium mb-1">Catatan / Revisi <span class="text-gray-400">(opsional)</span></label>
            <textarea name="note" id="note" rows="4" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">{{ old('note') }}</textarea>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                💾 Simpan Konfirmasi
            </button>
        </div>
    </form>
</div>
@endsection
