<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ManagerProductController extends Controller

{
    /**
     * Tampilkan daftar produk manager dengan filter kategori
     */
    public function index(Request $request)
    {
        $categories = Category::all(); // untuk dropdown filter

        $query = Product::query();

        // filter berdasarkan kategori jika ada
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();

        return view('manager.products.index', compact('products', 'categories'));
    }

    /**
     * Tampilkan form tambah produk
     */
    public function create()
    {
        $categories = Category::all(); // untuk dropdown kategori
        return view('manager.products.create', compact('categories'));
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('manager.products.index')
                         ->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Tampilkan detail produk (opsional)
     */
    public function show(Product $product)
    {
        return view('manager.products.show', compact('product'));
    }

    /**
     * Tampilkan form edit produk
     */
    public function edit(Product $product)
    {
        $categories = Category::all(); // untuk dropdown kategori
        return view('manager.products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($request->all());

        return redirect()->route('manager.products.index')
                         ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('manager.products.index')
                         ->with('success', 'Produk berhasil dihapus');
    }
}


