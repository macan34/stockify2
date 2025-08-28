<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\Auth;

class ManagerStockController extends Controller
{
    // Tampilkan semua produk dan stok
    public function index()
    {
        $products = Product::all(); // wajib dikirim ke view
        return view('manager.stock.index', compact('products'));
    }

    // Halaman tambah stok
    public function create()
    {
        $products = Product::all();
        return view('manager.stock.create', compact('products'));
    }

    // Simpan transaksi stok masuk / keluar
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:masuk,keluar',
            'note' => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($request->product_id);

        // cek stok cukup jika keluar
        if($request->type == 'keluar' && $request->quantity > $product->stock){
            return back()->with('error', 'Stok tidak cukup!');
        }

        // buat transaksi
        $transaction = new StockTransaction();
        $transaction->product_id = $product->id;
        $transaction->type = $request->type;
        $transaction->quantity = $request->quantity;
        $transaction->user_id = Auth::id();
        $transaction->note = $request->note ?? ($request->type == 'keluar' ? 'Barang keluar' : 'Barang masuk');
        $transaction->checked_by = null; // agar staff bisa konfirmasi
        $transaction->save();

        // update stok produk
        if($request->type == 'masuk'){
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        return redirect()->route('manager.stock.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Halaman edit produk (opsional)
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('manager.stock.edit', compact('product'));
    }

    // Update produk (opsional)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ]);

        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('manager.stock.index')->with('success', 'Produk berhasil diupdate.');
    }

    // Hapus produk (opsional)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('manager.stock.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function stockOut(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($request->product_id);
    $quantity = $request->quantity;
    $userId = auth()->id();

    if ($product->stock < $quantity) {
        return back()->with('error', 'Stok tidak mencukupi!');
    }

    // kurangi stok
    $product->stock -= $quantity;
    $product->save();

    // catat transaksi keluar (nyambung ke data lain)
    \App\Models\StockTransaction::create([
        'product_id' => $product->id,
        'quantity' => $quantity,
        'type' => 'keluar',
        'user_id' => $userId,
    ]);

    // catat log aktivitas (nyambung ke activity logs)
    \App\Models\ActivityLog::create([
        'user_id' => $userId,
        'action' => 'Barang keluar (Manager)',
        'details' => 'Produk: ' . $product->name . ', Jumlah: ' . $quantity,
    ]);

    return redirect()->back()->with('success', 'Transaksi keluar berhasil dicatat.');
}
}
