<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\Product;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::with('product','user')->latest()->get();
        return view('staff.barang-keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $products = Product::all();
        return view('staff.barang-keluar.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        if($request->quantity > $product->stock){
            return redirect()->back()->withErrors(['quantity'=>'Stok tidak mencukupi']);
        }

        $barang = BarangKeluar::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'user_id' => auth()->id(),
        ]);

        // update stock
        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('staff.barang-keluar.index')->with('success', 'Barang keluar berhasil ditambahkan.');
    }

  public function processOutgoingConfirm(Request $request, $id)
{
    $task = StockTransaction::findOrFail($id);

    $request->validate([
        'note' => 'nullable|string|max:500',
        'status' => 'required|in:approved,rejected',
    ]);

    $task->checked_by = auth()->id();
    $task->note = $request->note;
    $task->status = $request->status; // ⬅️ tambahkan ini
    $task->save();

    if ($request->status === 'approved') {
        $task->product->decrement('stock', $task->quantity);
    }

    return redirect()->route('staff.dashboard')->with('success', 'Barang keluar berhasil dikonfirmasi.');
}




}
