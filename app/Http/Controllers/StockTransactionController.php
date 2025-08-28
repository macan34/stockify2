<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\Product;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tampilkan semua transaksi
    public function index()
    {
        $transactions = StockTransaction::with('product','user')->orderBy('created_at','desc')->get();
        return view('stock_transactions.index', compact('transactions'));
    }

    // form tambah transaksi
    public function create()
    {
        $products = Product::all();
        return view('stock_transactions.create', compact('products'));
    }

    // simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'required',
            'type'=>'required|in:in,out',
            'quantity'=>'required|integer|min:1',
            'note'=>'nullable'
        ]);

        StockTransaction::create([
            'product_id'=>$request->product_id,
            'user_id'=>auth()->id(),
            'type'=>$request->type,
            'quantity'=>$request->quantity,
            'note'=>$request->note
        ]);

        // update stok produk
        $product = Product::find($request->product_id);
        if($request->type=='in'){
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        return redirect()->route('stock-transactions.index')->with('success','Transaksi berhasil disimpan');
    }

    public function destroy(StockTransaction $stockTransaction)
    {
        // rollback stok
        $product = $stockTransaction->product;
        if($stockTransaction->type=='in'){
            $product->decrement('stock', $stockTransaction->quantity);
        } else {
            $product->increment('stock', $stockTransaction->quantity);
        }

        $stockTransaction->delete();
        return redirect()->route('stock-transactions.index')->with('success','Transaksi berhasil dihapus');
    }
}
