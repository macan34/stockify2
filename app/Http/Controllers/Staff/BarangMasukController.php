<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Product;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with(['product','user'])->latest()->get();
        return view('staff.barang-masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $products = Product::all();
        return view('staff.barang-masuk.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        BarangMasuk::create([
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'user_id'    => auth()->id(),
            'status'     => 'pending',
        ]);

        return redirect()->route('staff.barang-masuk.index')
            ->with('success', 'Barang masuk berhasil ditambahkan, menunggu konfirmasi.');
    }

// Konfirmasi Barang Masuk
public function processIncomingConfirm(Request $request, $id)
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
        $task->product->increment('stock', $task->quantity);
    }

    return redirect()->route('staff.dashboard')->with('success', 'Barang masuk berhasil dikonfirmasi.');
}

}
