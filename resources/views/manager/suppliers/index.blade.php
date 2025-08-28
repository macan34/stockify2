@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Supplier</h1>
        <p class="text-gray-600">Informasi lengkap supplier beserta kontak dan alamat.</p>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama Supplier</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Kontak</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Alamat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($suppliers as $s)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <!-- Nama Supplier -->
                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $s->name }}
                    </td>

                    <!-- Kontak -->
                    <td class="px-4 py-3 text-gray-700">
                        <div class="space-y-2">
                            <!-- Email -->
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-2 text-blue-500"></i>
                                @if($s->email)
                                    <a href="mailto:{{ $s->email }}" 
                                       class="hover:underline text-blue-600"
                                       title="Kirim Email ke {{ $s->email }}">
                                        {{ $s->email }}
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </div>

                            <!-- WhatsApp -->
                            <div class="flex items-center">
                                <i class="fas fa-phone mr-2 text-green-500"></i>
                                @if($s->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $s->phone) }}" 
                                       target="_blank" 
                                       class="hover:underline text-green-600"
                                       title="Chat via WhatsApp">
                                        {{ $s->phone }}
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Alamat -->
                    <td class="px-4 py-3 text-gray-700">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-2 text-red-500 mt-1"></i>
                            <span>{{ $s->address ?? '-' }}</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
