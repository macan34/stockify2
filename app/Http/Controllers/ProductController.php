<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // wajib login
    }

    // tampilkan semua produk
    public function index()
    {
        $products = Product::with(['category','supplier'])->paginate(10); 
        return view('products.index', compact('products'));
    }

    // form tambah produk
    public function create()
    {
        $categories = Category::all();
        $suppliers  = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    // simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('name', 'category_id', 'stock', 'supplier_id', 'price');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $product = Product::create($data);
        $userId  = auth()->id() ?? 1;

        // catat transaksi stok masuk otomatis
        if ($product->stock > 0) {
            StockTransaction::create([
                'product_id' => $product->id,
                'quantity'   => $product->stock,
                'type'       => 'masuk',
                'user_id'    => $userId,
            ]);
        }

        ActivityLog::create([
            'user_id' => $userId,
            'action'  => 'Menambah produk baru',
            'details' => 'Produk: ' . $product->name,
        ]);

        // tetap redirect ke index setelah tambah produk baru
        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan.');
    }

    // form edit produk
    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers  = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    // update produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('name', 'category_id', 'price', 'stock', 'supplier_id');

        if ($request->hasFile('image')) {
            // hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $oldStock = $product->stock;
        $newStock = $request->stock;

        $product->update($data);

        $userId = auth()->id() ?? 1;

        // catat perubahan stok
        if ($newStock > $oldStock) {
            $added = $newStock - $oldStock;
            StockTransaction::create([
                'product_id' => $product->id,
                'quantity'   => $added,
                'type'       => 'masuk',
                'user_id'    => $userId,
            ]);
        } elseif ($newStock < $oldStock) {
            $reduced = $oldStock - $newStock;
            StockTransaction::create([
                'product_id' => $product->id,
                'quantity'   => $reduced,
                'type'       => 'keluar',
                'user_id'    => $userId,
            ]);
        }

        ActivityLog::create([
            'user_id' => $userId,
            'action'  => 'Update produk',
            'details' => 'Produk: ' . $product->name,
        ]);

        // redirect ke halaman create dengan pesan sukses setelah update produk
        return redirect()->route('products.create')->with('success', 'Produk berhasil diperbarui!');
    }

    // hapus produk
    public function destroy(Product $product)
    {
        // hapus gambar dari storage jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success','Produk berhasil dihapus');
    }

    // tampilkan detail produk
    public function show(Product $product)
    {
        $product->load(['category', 'supplier', 'transactions.user']);
        return view('products.show', compact('product'));
    }

    // barang masuk
    public function stockIn(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $product->increment('stock', $request->quantity);

        StockTransaction::create([
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
            'type'       => 'masuk',
            'user_id'    => auth()->id() ?? 1,
        ]);

        return redirect()->route('products.show', $product->id)
            ->with('success', 'Stok berhasil ditambahkan.');
    }

    // barang keluar
    public function stockOut(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        $product->decrement('stock', $request->quantity);

        StockTransaction::create([
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
            'type'       => 'keluar',
            'user_id'    => auth()->id() ?? 1,
        ]);

        return redirect()->route('products.show', $product->id)
            ->with('success', 'Stok berhasil dikurangi.');
    }

    // barang keluar (form khusus)
    public function keluar(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $quantity = $request->quantity;
        $userId   = auth()->id() ?? 1;

        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        $product->decrement('stock', $quantity);

        StockTransaction::create([
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'type'       => 'keluar',
            'user_id'    => $userId,
        ]);

        ActivityLog::create([
            'user_id' => $userId,
            'action'  => 'Barang keluar',
            'details' => 'Produk: ' . $product->name . ', Jumlah: ' . $quantity,
        ]);

        return redirect()->back()->with('success', 'Transaksi keluar berhasil dicatat.');
    }
}
