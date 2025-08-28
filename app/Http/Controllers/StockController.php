<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class StockController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with(['product', 'user'])->latest()->get();
        return view('stock.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'type'       => 'required|in:masuk,keluar',
        ]);

        $product = Product::findOrFail($request->product_id);
        $userId = auth()->id() ?? 1;

        // update stok produk
        if ($request->type == 'masuk') {
            $product->increment('stock', $request->quantity);
        } else {
            if ($product->stock < $request->quantity) {
                return back()->with('error', 'Stok tidak cukup untuk dikurangi!');
            }
            $product->decrement('stock', $request->quantity);
        }

        // simpan transaksi
        StockTransaction::create([
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'type'       => $request->type,
            'user_id'    => $userId,
        ]);

        // catat aktivitas
        ActivityLog::create([
            'user_id' => $userId,
            'action'  => "Stok {$request->type}",
            'details' => "Produk: {$product->name}, Jumlah: {$request->quantity}",
        ]);

        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil dicatat.');
    }

    public function edit(StockTransaction $stock)
    {
        $products = Product::all();
        return view('stock.edit', compact('stock', 'products'));
    }

    public function update(Request $request, StockTransaction $stock)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'type'       => 'required|in:masuk,keluar',
        ]);

        $stock->update($request->only('product_id', 'quantity', 'type'));

        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil diupdate.');
    }

    public function destroy(StockTransaction $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Transaksi stok berhasil dihapus.');
    }
}
