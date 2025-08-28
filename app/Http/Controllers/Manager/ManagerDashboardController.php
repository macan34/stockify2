<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\ActivityLog;
use Carbon\Carbon;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $transactionsIn = StockTransaction::where('type', 'masuk')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('quantity');

        $transactionsOut = StockTransaction::where('type', 'keluar')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('quantity');

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

        $lowStockProducts = Product::where('stock', '<=', 5)->get();

        $recentActivities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.manager', compact(
            'days',
            'inData',
            'outData',
            'totalProducts',
            'transactionsIn',
            'transactionsOut',
            'lowStockProducts',
            'recentActivities'
        ));
    }
}
