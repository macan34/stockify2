<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\ActivityLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total produk
        $totalProducts = Product::count();

        // 2. Transaksi masuk/keluar bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $transactionsIn = StockTransaction::where('type', 'masuk')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('quantity');

        $transactionsOut = StockTransaction::where('type', 'keluar')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('quantity');

        // 3. Grafik stok masuk/keluar (30 hari terakhir)
        $days = [];
        $inData = [];
        $outData = [];

        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->subDays(29 - $i);
            $days[] = $date->format('d M');

            $inData[] = StockTransaction::where('type', 'masuk')
                ->whereDate('created_at', $date)
                ->sum('quantity');

            $outData[] = StockTransaction::where('type', 'keluar')
                ->whereDate('created_at', $date)
                ->sum('quantity');
        }

        // 4. Produk stok rendah
        $lowStockProducts = Product::where('stock', '<=', 5)->get();

        // 5. Aktivitas pengguna terbaru
        $recentActivities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

return view('dashboard.admin', compact(
    'days',
    'inData',
    'outData',
    'totalProducts',
    'transactionsIn',
    'transactionsOut',
    'lowStockProducts',
    'recentActivities'
));
// return dd([
//     'days'            => $days,
//     'inData'          => $inData,
//     'outData'         => $outData,
//     'totalProducts'   => $totalProducts,
//     'transactionsIn'  => $transactionsIn,
//     'transactionsOut' => $transactionsOut,
//     'lowStockProducts'=> $lowStockProducts ?? null,
//     'recentActivities'=> $recentActivities ?? null,
// ]);
    }
}
