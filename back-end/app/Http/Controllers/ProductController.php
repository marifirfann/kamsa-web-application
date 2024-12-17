<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan form untuk membuat produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Menangani upload gambar jika ada
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('public/products'); // Menyimpan gambar di folder 'public/products'
        } else {
            $imagePath = null; // Jika tidak ada gambar yang diupload
        }

        // Menyimpan produk ke database
        $product = Product::create([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'product_image' => $imagePath, // Menyimpan path gambar di database
        ]);

        // Redirect atau memberikan response
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::all(); // Mendapatkan semua produk
        return view('products.index', compact('products'));
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Mendapatkan produk berdasarkan ID
        return view('products.edit', compact('product'));
    }

    // Menyimpan perubahan produk
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id); // Mendapatkan produk berdasarkan ID

        // Menangani upload gambar baru jika ada
        if ($request->hasFile('product_image')) {
            // Hapus gambar lama jika ada
            if ($product->product_image && Storage::exists($product->product_image)) {
                Storage::delete($product->product_image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('product_image')->store('public/products');
        } else {
            $imagePath = $product->product_image; // Jika tidak ada gambar baru, biarkan gambar lama
        }

        // Update produk
        $product->update([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'product_image' => $imagePath, // Update path gambar
        ]);

        // Redirect atau memberikan response
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }
}
