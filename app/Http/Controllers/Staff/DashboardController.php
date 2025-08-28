<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use App\Models\Product;
use App\Models\StockOpname;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Barang masuk/keluar yang belum dikonfirmasi
        $incomingTasks = StockTransaction::where('type', 'masuk')
            ->whereDate('created_at', $today)
            ->whereNull('checked_by')
            ->get();

        $outgoingTasks = StockTransaction::where('type', 'keluar')
            ->whereDate('created_at', $today)
            ->whereNull('checked_by')
            ->get();
$approvedCount = StockTransaction::where('status', 'approved')->count();
$rejectedCount = StockTransaction::where('status', 'rejected')->count();

$summary = [
    'incoming_count' => $incomingTasks->count(),
    'outgoing_count' => $outgoingTasks->count(),
    'low_stock' => Product::where('stock', '<=', 5)->count(),
    'approved_count' => $approvedCount,
    'rejected_count' => $rejectedCount,
];
        return view('dashboard.staff', compact('incomingTasks', 'outgoingTasks', 'summary'));
    }

    // Konfirmasi Barang Masuk
    public function showIncomingConfirm($id)
    {
        $task = StockTransaction::with('product')->findOrFail($id);
        return view('staff.incoming_confirm', compact('task'));
    }

    public function processIncomingConfirm(Request $request, $id)
    {
        $task = StockTransaction::findOrFail($id);

        $request->validate([
            'note' => 'nullable|string|max:500',
        ]);

        $task->checked_by = auth()->id();
        $task->note = $request->note;
        $task->save();

        $task->product->increment('stock', $task->quantity);

        return redirect()->route('staff.dashboard')->with('success', 'Barang masuk berhasil dikonfirmasi.');
    }

    // Konfirmasi Barang Keluar
    public function showOutgoingConfirm($id)
    {
        $task = StockTransaction::with('product')->findOrFail($id);
        return view('staff.outgoing_confirm', compact('task'));
    }

    public function processOutgoingConfirm(Request $request, $id)
    {
        $task = StockTransaction::findOrFail($id);

        $request->validate([
            'note' => 'nullable|string|max:500',
        ]);

        $task->checked_by = auth()->id();
        $task->note = $request->note;
        $task->save();

        $task->product->decrement('stock', $task->quantity);

        return redirect()->route('staff.dashboard')->with('success', 'Barang keluar berhasil dikonfirmasi.');
    }

    // Stock Opname
    public function showStockOpname()
    {
        $products = Product::all();
        return view('staff.stock_opname', compact('products'));
    }

    public function processStockOpname(Request $request)
    {
        $data = $request->validate([
            'stocks' => 'required|array',
            'stocks.*' => 'nullable|integer|min:0',
        ]);

        foreach($data['stocks'] as $productId => $physicalStock) {
            $product = Product::find($productId);
            if(!$product) continue;

            StockOpname::updateOrCreate(
                [
                    'product_id' => $productId,
                    'user_id' => auth()->id(),
                    'created_at' => now()->format('Y-m-d')
                ],
                [
                    'stock_system' => $product->stock,
                    'stock_physical' => $physicalStock,
                    'real_stock' => $physicalStock,
                    'updated_at' => now(),
                ]
            );
        }

        return redirect()->route('staff.dashboard')->with('success', 'Stock opname berhasil disimpan.');
    }
}
