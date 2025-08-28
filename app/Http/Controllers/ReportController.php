<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\StockTransaction;
use App\Models\ActivityLog;
use App\Models\StockOpname;

class ReportController extends Controller
{

        public function index()
    {
        $transactions = StockTransaction::with('product','user')->orderBy('created_at','desc')->get();
        $opnames = StockOpname::with('product','user')->orderBy('created_at','desc')->get();
        $activities = ActivityLog::with('user')->orderBy('created_at','desc')->get();

        return view('admin.laporan.index', compact('transactions','opnames','activities'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Laporan stok
    public function stock(Request $request)
{
    $query = Product::with('category');

    // Filter kategori
    if ($request->stock_category) {
        $query->where('category_id', $request->stock_category);
    }

    // Filter pencarian produk
    if ($request->stock_search) {
        $query->where('name', 'like', '%' . $request->stock_search . '%');
    }

    $products = $query->get();

    // ambil semua kategori untuk dropdown
    $categories = Category::all();

    return view('reports.stock', compact('products', 'categories'));
}


    // Laporan transaksi
    public function transactions(Request $request)
    {
        $query = StockTransaction::with('product','user');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->orderBy('created_at','desc')->get();

        return view('reports.transactions', compact('transactions'));
    }

    // Laporan aktivitas pengguna
    public function activity(Request $request)
    {
        $query = ActivityLog::with('user');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $activities = $query->orderBy('created_at','desc')->get();

        return view('reports.activity', compact('activities'));
    }

   public function allReports(Request $request)
{
    // --- Laporan stok ---
    $productsQuery = Product::with('category');
    if ($request->stock_category) {
        $productsQuery->where('category_id', $request->stock_category);
    }
    if ($request->stock_search) {
        $productsQuery->where('name', 'like', '%' . $request->stock_search . '%');
    }
    $products = $productsQuery->get();

    // --- Laporan transaksi ---
    $transactionsQuery = StockTransaction::with('product','user');
    if ($request->trans_start && $request->trans_end) {
        $transactionsQuery->whereBetween('created_at', [$request->trans_start, $request->trans_end]);
    }
    if ($request->trans_search) {
        $transactionsQuery->whereHas('product', function($q) use ($request) {
            $q->where('name', 'like', '%' . $request->trans_search . '%');
        });
    }
    $transactions = $transactionsQuery->orderBy('created_at','desc')->get();

    // --- Laporan aktivitas ---
    $activityQuery = ActivityLog::with('user');
    if ($request->activity_user) {
        $activityQuery->where('user_id', $request->activity_user);
    }
    if ($request->activity_start && $request->activity_end) {
        $activityQuery->whereBetween('created_at', [$request->activity_start, $request->activity_end]);
    }
    $activities = $activityQuery->orderBy('created_at','desc')->get();

    // Data tambahan
    $categories = Category::all();
    $allProducts = Product::all();

    // Simpan anchor section biar bisa redirect balik ke posisi terakhir
    $section = $request->get('section', null);

    return view('reports.all', compact(
        'products','transactions','activities','categories','allProducts','section'
    ));
}


}
