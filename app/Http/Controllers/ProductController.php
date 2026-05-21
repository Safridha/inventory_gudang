<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /*
    |-------------------------------
    | INDEX (SEARCH + FILTER)
    |-------------------------------
    */
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%")
                      ->orWhere('sku', 'like', "%{$request->search}%");
            })
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->latest()
            ->get();

        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    /*
    |-------------------------------
    | STORE (CREATE PRODUCT)
    |-------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'name'        => 'required',
            'sku'         => 'required',
            'stock'       => 'required|numeric',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products', $filename, 'public');
            $validated['image'] = $filename;
        }

        Product::create($validated);

        return redirect()->route('products.index');
    }

    /*
    |-------------------------------
    | EDIT PAGE
    |-------------------------------
    */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /*
    |-------------------------------
    | UPDATE PRODUCT
    |-------------------------------
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'name'        => 'required',
            'sku'         => 'required',
            'stock'       => 'required|numeric',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {

            // hapus image lama
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products', $filename, 'public');

            $validated['image'] = $filename;
        }

        $product->update($validated);

        return redirect()->route('products.index');
    }

    /*
    |-------------------------------
    | DELETE PRODUCT
    |-------------------------------
    */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete('products/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}