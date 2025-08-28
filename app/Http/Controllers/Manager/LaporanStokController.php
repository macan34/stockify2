<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\StockTransaction;
use Maatwebsite\Excel\Facades\Excel; // jika pakai export Excel
use App\Exports\LaporanStokExport;

class LaporanStokController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();

        $query = StockTransaction::query();

        // filter produk
        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        // filter kategori
        if ($request->category_id) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        // filter tanggal
        if ($request->from) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->to) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $transactions = $query->with('product')->orderBy('created_at', 'desc')->get();

        return view('manager.laporan.index', compact('transactions', 'products', 'categories'));
    }

    // opsional: export ke excel
    // public function export(Request $request)
    // {
    //     return Excel::download(new LaporanStokExport($request), 'laporan_stok.xlsx');
    // }
}
