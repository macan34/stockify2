<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\StockOpname;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StockTransaction;

class ManagerStockOpnameController extends Controller
{
    // list stock opname
    public function index()
    {
        $opnames = StockOpname::with('product', 'user')->latest()->get();
        return view('manager.stock.stock-opname.index', compact('opnames'));
    }

    // form create opname
    public function create()
    {
        $products = Product::all();
        return view('manager.stock.stock-opname.create', compact('products'));
    }

    // simpan opname
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock_physical' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($request->product_id);

        // buat data opname
        $opname = StockOpname::create([
            'product_id' => $product->id,
            'stock_system' => $product->stock,
            'stock_physical' => $request->stock_physical,
            'real_stock' => $request->stock_physical,
            'user_id' => Auth::id(),
        ]);

        // hitung selisih
        $selisih = $request->stock_physical - $product->stock;

        // update stok produk sesuai hasil opname
        $product->update(['stock' => $request->stock_physical]);

        // catat transaksi jika ada perbedaan
        if ($selisih != 0) {
            StockTransaction::create([
                'product_id' => $product->id,
                'type' => $selisih > 0 ? 'masuk' : 'keluar',
                'quantity' => abs($selisih),
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('manager.stock-opname.index')
            ->with('success', 'Stock opname berhasil disimpan.');
    }

    public function out(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($request->product_id);

    // pastikan stok cukup
    if ($product->stock < $request->quantity) {
        return back()->with('error', 'Stok tidak mencukupi!');
    }

    // kurangi stok
    $product->decrement('stock', $request->quantity);

    // catat transaksi keluar
    \App\Models\StockTransaction::create([
        'product_id' => $product->id,
        'type'       => 'keluar',
        'quantity'   => $request->quantity,
        'user_id'    => Auth::id(),
    ]);

    return back()->with('success', 'Stok berhasil dikurangi.');
}

}
