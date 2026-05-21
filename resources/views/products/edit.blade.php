<!DOCTYPE html>
<html>
<head>
    <title>Edit Product - Inventory Gudang</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .card {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            background: #2ecc71;
            color: white;
            font-size: 16px;
        }

        button:hover {
            background: #27ae60;
        }

        .image-preview {
            text-align: center;
            margin: 10px 0;
        }

        .image-preview img {
            width: 120px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #3498db;
        }

        .back:hover {
            text-decoration: underline;
        }

        label {
            font-size: 13px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="card">

<h2>✏️ Edit Product</h2>

<form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Category</label>
    <select name="category_id">
        @foreach($categories as $c)
            <option value="{{ $c->id }}"
                {{ $product->category_id == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
        @endforeach
    </select>

    <label>Nama Product</label>
    <input type="text" name="name" value="{{ $product->name }}">

    <label>SKU</label>
    <input type="text" name="sku" value="{{ $product->sku }}">

    <label>Stock</label>
    <input type="number" name="stock" value="{{ $product->stock }}">

    <label>Price</label>
    <input type="number" name="price" value="{{ $product->price }}">

    <label>Image</label>
    <input type="file" name="image">

    @if($product->image)
        <div class="image-preview">
            <p>Current Image:</p>
            <img src="{{ asset('storage/products/' . $product->image) }}">
        </div>
    @endif

    <button type="submit">Update Product</button>
</form>

<a class="back" href="/products">← Back to Products</a>

</div>

</body>
</html>