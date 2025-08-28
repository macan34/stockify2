<?php

namespace App\Http\Controllers;

use App\Models\StockOpname;
use App\Models\Product;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tampilkan semua stock opname
    public function index()
    {
        $opnames = StockOpname::with('product','user')->orderBy('created_at','desc')->get();
        return view('stock_opnames.index', compact('opnames'));
    }

    // form tambah stock opname
    public function create()
    {
        $products = Product::all();
        return view('stock_opnames.create', compact('products'));
    }

    // simpan stock opname
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'required',
            'actual_stock'=>'required|integer|min:0',
            'note'=>'nullable'
        ]);

        $product = Product::find($request->product_id);

        StockOpname::create([
            'product_id'=>$request->product_id,
            'user_id'=>auth()->id(),
            'system_stock'=>$product->stock,
            'actual_stock'=>$request->actual_stock,
            'difference'=>$request->actual_stock - $product->stock,
            'note'=>$request->note
        ]);

        // update stok sistem agar sesuai fisik
        $product->stock = $request->actual_stock;
        $product->save();

        return redirect()->route('stock-opnames.index')->with('success','Stock opname berhasil disimpan');
    }

    public function destroy(StockOpname $stockOpname)
    {
        $stockOpname->delete();
        return redirect()->route('stock-opnames.index')->with('success','Stock opname berhasil dihapus');
    }
}
