<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // INDEX + SEARCH + FILTER
    public function index(Request $request)
    {
        $query = Product::with('category');

        // SEARCH (name / sku)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER CATEGORY
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->get();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // STORE (CREATE + IMAGE)
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'sku' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only([
            'category_id', 'name', 'sku', 'stock', 'price'
        ]);

        // UPLOAD IMAGE
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products', $filename, 'public');
            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect('/products');
    }

    // UPDATE + IMAGE REPLACE
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'sku' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = Product::findOrFail($id);

        $data = $request->only([
            'category_id', 'name', 'sku', 'stock', 'price'
        ]);

        // UPDATE IMAGE (hapus lama jika ada)
        if ($request->hasFile('image')) {

            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('products', $filename, 'public');

            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect('/products');
    }

    // DELETE + HAPUS IMAGE
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete('products/' . $product->image);
        }

        $product->delete();

        return redirect('/products');
    }
}