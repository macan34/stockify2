<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Controllers\SettingController;

use App\Http\Controllers\Manager\ManagerStockController;
use App\Http\Controllers\Manager\ManagerStockOpnameController;
use App\Http\Controllers\Manager\ManagerProductController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\BarangMasukController;
use App\Http\Controllers\Staff\BarangKeluarController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\StockController;

// Homepage
Route::get('/', function () {
    return view('auth.login');
});

// Auth routes
require __DIR__.'/auth.php';

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Products (CRUD)
Route::middleware('auth')->prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
   Route::post('/{product}/keluar', [ProductController::class, 'keluar'])->name('keluar');

});

// Categories
Route::middleware('auth')->prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

// Suppliers
Route::middleware('auth')->prefix('suppliers')->name('suppliers.')->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('index');
    Route::get('/create', [SupplierController::class, 'create'])->name('create');
    Route::post('/', [SupplierController::class, 'store'])->name('store');
    Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('edit');
    Route::put('/{supplier}', [SupplierController::class, 'update'])->name('update');
    Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy');
});

// Stock Transactions
Route::middleware('auth')->prefix('stock-transactions')->name('stock-transactions.')->group(function () {
    Route::get('/', [StockTransactionController::class, 'index'])->name('index');
    Route::get('/create', [StockTransactionController::class, 'create'])->name('create');
    Route::post('/', [StockTransactionController::class, 'store'])->name('store');
    Route::get('/{transaction}/edit', [StockTransactionController::class, 'edit'])->name('edit');
    Route::put('/{transaction}', [StockTransactionController::class, 'update'])->name('update');
    Route::delete('/{transaction}', [StockTransactionController::class, 'destroy'])->name('destroy');
});

// Stock Opname
Route::middleware('auth')->prefix('stock-opnames')->name('stock-opnames.')->group(function () {
    Route::get('/', [StockOpnameController::class, 'index'])->name('index');
    Route::get('/create', [StockOpnameController::class, 'create'])->name('create');
    Route::post('/', [StockOpnameController::class, 'store'])->name('store');
    Route::get('/{opname}/edit', [StockOpnameController::class, 'edit'])->name('edit');
    Route::put('/{opname}', [StockOpnameController::class, 'update'])->name('update');
    Route::delete('/{opname}', [StockOpnameController::class, 'destroy'])->name('destroy');
});

// Reports
Route::middleware('auth')->prefix('reports')->name('reports.')->group(function () {
    Route::get('/stock', [ReportController::class, 'stock'])->name('stock');
    Route::get('/transactions', [ReportController::class, 'transactions'])->name('transactions');
    Route::get('/activity', [ReportController::class, 'activity'])->name('activity');
});

// Users (Admin only)
Route::resource('users', UserController::class)->middleware(['auth', 'role:admin']);

// ---------------- Role-Based Dashboards ---------------- //

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
});

// // Manager
// Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {

//     // Dashboard
//     Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');

//     // Produk Manager (hanya satu controller)
//   Route::resource('products', \App\Http\Controllers\Manager\ManagerProductController::class);

//     // Stock Manager
//     Route::prefix('stock')->name('stock.')->group(function () {
//         Route::get('/', [ManagerStockController::class, 'index'])->name('index');
//         Route::get('/create', [ManagerStockController::class, 'create'])->name('create');
//         Route::post('/store', [ManagerStockController::class, 'store'])->name('store');
//     });

//     // Stock Opname Manager
//     Route::prefix('stock-opname')->name('stock-opname.')->group(function () {
//         Route::get('/', [ManagerStockOpnameController::class, 'index'])->name('index');
//         Route::get('/create', [ManagerStockOpnameController::class, 'create'])->name('create');
//         Route::post('/store', [ManagerStockOpnameController::class, 'store'])->name('store');    
//     });


     //Route::get('laporan', [App\Http\Controllers\Manager\LaporanStokController::class, 'index'])->name('laporan.index');

// Route::get('manager/laporan-stok/export', [App\Http\Controllers\Manager\LaporanStokController::class, 'export'])->name('manager.laporan-stok.export'); // opsional
//});

// Staff
// ---------------- Manager Routes ---------------- //
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');

    // Produk Manager
    Route::resource('products', ManagerProductController::class);

    // Stock Manager
    Route::resource('stock', ManagerStockController::class)->only(['index','create','store']);

    // Stock Opname Manager (full routes)
    Route::resource('stock-opname', ManagerStockOpnameController::class)->only([
        'index','create','store'
    ]);

    // tambahan khusus stock opname (keluar / in-out stok)
    Route::post('/stock-opname/out', [ManagerStockOpnameController::class, 'out'])->name('stock-opname.out');
    Route::post('/stock-opname/in', [ManagerStockOpnameController::class, 'in'])->name('stock-opname.in');

    // Laporan Manager
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [ReportController::class, 'allReports'])->name('index'); 
        Route::get('/stock', [ReportController::class, 'stock'])->name('stock');
        Route::get('/transactions', [ReportController::class, 'transactions'])->name('transactions');
        Route::get('/activity', [ReportController::class, 'activity'])->name('activity');
    });

    // Supplier Manager
    Route::prefix('suppliers')->name('suppliers.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Manager\ManagerSupplierController::class, 'index'])->name('index');
    });
});



Route::middleware(['auth', 'role:staff'])->group(function() {
Route::get('/dashboard/staff', [DashboardController::class, 'index'])->name('staff.dashboard');

    Route::get('/dashboard/staff/incoming/confirm/{id}', [DashboardController::class, 'showIncomingConfirm'])->name('staff.incoming.confirm');
    Route::post('/dashboard/staff/incoming/confirm/{id}', [DashboardController::class, 'processIncomingConfirm'])->name('staff.incoming.confirm.process');

    Route::get('/dashboard/staff/outgoing/confirm/{id}', [DashboardController::class, 'showOutgoingConfirm'])->name('staff.outgoing.confirm');
    Route::post('/dashboard/staff/outgoing/confirm/{id}', [DashboardController::class, 'processOutgoingConfirm'])->name('staff.outgoing.confirm.process');

    Route::get('/dashboard/staff/stock-opname', [DashboardController::class, 'showStockOpname'])->name('staff.stock_opname');
    Route::post('/dashboard/staff/stock-opname', [DashboardController::class, 'processStockOpname'])->name('staff.stock_opname.process');
});

Route::resource('products', ProductController::class);

// route untuk tambah / kurangi stok
Route::post('products/{product}/stock-in', [ProductController::class, 'stockIn'])->name('products.stock.in');
Route::post('products/{product}/stock-out', [ProductController::class, 'stockOut'])->name('products.stock.out');

Route::resource('stocks', StockController::class);

Route::middleware(['auth'])->group(function () {
    // Route untuk pengaturan
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
        Route::post('/reset', [SettingController::class, 'reset'])->name('settings.reset');
    });
});