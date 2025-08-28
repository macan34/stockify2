@extends('layouts.app')

@section('title', 'Stock Opname')

@section('content')
<div class="p-6">
    <!-- Header with Enhanced Animation -->
    <div class="flex justify-between items-center mb-8 fade-in">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight" style="color:var(--text-color)">
                <i class="fas fa-clipboard-check mr-2" style="color:var(--primary-color)"></i> Stock Opname
            </h1>
            <p class="text-base opacity-80 mt-2" style="color:var(--text-muted)">
                Lakukan pengecekan stok fisik dan sesuaikan dengan sistem.
            </p>
        </div>
        <a href="{{ url()->previous() }}" 
           class="px-5 py-3 rounded-xl font-medium shadow-md hover-lift transition-all duration-300 flex items-center"
           style="background:var(--panel-color); color:var(--text-color); border: 1px solid var(--border-color);">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Stock Opname Form -->
    <div class="modern-card p-6 rounded-2xl fade-in" style="background:var(--card-bg); animation-delay: 0.2s;">
        <form action="{{ route('staff.stock_opname.process') }}" method="POST">
            @csrf

            <!-- Info Card -->
            <div class="mb-6 p-4 rounded-xl flex items-center" 
                 style="background:color-mix(in srgb, var(--info-color) 10%, transparent); border-left: 4px solid var(--info-color);">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-4" 
                     style="background:var(--info-color); color:white;">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div>
                    <p class="font-medium" style="color:var(--text-color)">Petunjuk Stock Opname</p>
                    <p class="text-sm mt-1" style="color:var(--text-muted)">
                        Hitung stok fisik secara manual, lalu masukkan jumlahnya pada kolom "Stok Fisik". 
                        Sistem akan secara otomatis menyesuaikan perbedaan dengan stok sistem.
                    </p>
                </div>
            </div>

            <!-- Products Table -->
            <div class="overflow-x-auto rounded-xl" style="border: 1px solid var(--border-color);">
                <table class="w-full text-sm">
                    <thead>
                        <tr style="background:var(--panel-color);">
                            <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Produk</th>
                            <th class="p-4 font-semibold text-center" style="color:var(--text-color)">Stok Sistem</th>
                            <th class="p-4 font-semibold text-center" style="color:var(--text-color)">Stok Fisik (Hitung Manual)</th>
                            <th class="p-4 font-semibold text-center" style="color:var(--text-color)">Selisih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                        <tr class="border-t transition-colors hover:bg-gray-800/10" style="border-color:var(--border-color)">
                            <td class="p-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 shadow-md"
                                         style="background:color-mix(in srgb, var(--primary-color) 15%, transparent); color:var(--primary-color);">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium" style="color:var(--text-color)">{{ $product->name }}</p>
                                        <p class="text-xs opacity-70" style="color:var(--text-muted)">#{{ $product->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1.5 rounded-full text-xs font-semibold
                                    {{ $product->stock > 10 ? 'bg-green-600/20 text-green-400' :
                                       ($product->stock > 0 ? 'bg-yellow-600/20 text-yellow-400' : 'bg-red-600/20 text-red-400') }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <input type="number" 
                                       name="stocks[{{ $product->id }}]" 
                                       value="{{ old('stocks.'.$product->id, $product->stock) }}" 
                                       min="0"
                                       class="px-3 py-2 rounded-lg border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all text-center"
                                       style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color); width: 100px;"
                                       oninput="calculateDifference(this, {{ $product->stock }})">
                            </td>
                            <td class="p-4 text-center">
                                <span id="difference-{{ $product->id }}" class="px-3 py-1.5 rounded-full text-xs font-semibold">
                                    0
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 flex justify-center">
                <button type="submit" 
                        class="px-8 py-3.5 rounded-xl font-medium hover-lift transition-all flex items-center"
                        style="background:var(--primary-color); color:white;">
                    <i class="fas fa-save mr-2"></i> Simpan Stock Opname
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function calculateDifference(input, systemStock) {
    const physicalStock = parseInt(input.value) || 0;
    const difference = physicalStock - systemStock;
    const differenceElement = document.getElementById('difference-' + input.name.match(/\d+/)[0]);
    
    differenceElement.textContent = difference >= 0 ? '+' + difference : difference;
    
    // Update color based on difference
    if (difference > 0) {
        differenceElement.className = 'px-3 py-1.5 rounded-full text-xs font-semibold bg-green-600/20 text-green-400';
    } else if (difference < 0) {
        differenceElement.className = 'px-3 py-1.5 rounded-full text-xs font-semibold bg-red-600/20 text-red-400';
    } else {
        differenceElement.className = 'px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-600/20 text-gray-400';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Add animations to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        
        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, 100 + (index * 50));
    });
    
    // Initialize differences for pre-filled values
    const inputs = document.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        const match = input.name.match(/\d+/);
        if (match) {
            const productId = match[0];
            const systemStock = parseInt(input.dataset.systemStock) || 0;
            calculateDifference(input, systemStock);
        }
    });
});
</script>
@endsection