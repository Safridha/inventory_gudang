<!DOCTYPE html>
<html>
<head>
    <title>Inventory Gudang - Products</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h2, h3 {
            margin-bottom: 10px;
        }

        /* CARD */
        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 15px;
        }

        /* FORM */
        input, select {
            padding: 8px;
            margin: 5px 5px 5px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-edit {
            background: #2ecc71;
            color: white;
        }

        .btn-reset {
            background: #95a5a6;
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
        }

        /* PRODUCT CARD */
        .product {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product img {
            border-radius: 8px;
            object-fit: cover;
        }

        .actions {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>

<h2>📦 Inventory Gudang - Products</h2>

{{-- ================= SEARCH & FILTER ================= --}}
<div class="card">

<form method="GET" action="/products">

    <input type="text" name="search" placeholder="Cari nama / SKU"
        value="{{ request('search') }}">

    <select name="category_id">
        <option value="">Semua Category</option>
        @foreach($categories as $c)
            <option value="{{ $c->id }}"
                {{ request('category_id') == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
        @endforeach
    </select>

    <button class="btn-primary" type="submit">Filter</button>

    <a class="btn-reset" href="/products">Reset</a>
</form>

</div>

{{-- ================= CREATE PRODUCT ================= --}}
<div class="card">

<h3>➕ Tambah Product</h3>

<form action="/products" method="POST" enctype="multipart/form-data">
    @csrf

    <select name="category_id">
        <option value="">Pilih Category</option>
        @foreach($categories as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>

    <input type="text" name="name" placeholder="Nama product">
    <input type="text" name="sku" placeholder="SKU">
    <input type="number" name="stock" placeholder="Stock">
    <input type="number" name="price" placeholder="Price">
    <input type="file" name="image">

    <button class="btn-primary" type="submit">Simpan</button>
</form>

</div>

{{-- ================= LIST PRODUCTS ================= --}}
<h3>📋 List Products</h3>

@foreach($products as $p)

<div class="card product">

    <div class="product-info">

        @if($p->image)
            <img src="{{ asset('storage/products/' . $p->image) }}" width="70" height="70">
        @endif

        <div>
            <b>{{ $p->name }}</b><br>
            <small>SKU: {{ $p->sku }}</small><br>
            <small>Stock: {{ $p->stock }}</small><br>
            <small>Price: Rp {{ number_format($p->price) }}</small>
        </div>

    </div>

    <div class="actions">

        <a href="/products/{{ $p->id }}/edit">
            <button class="btn-edit" type="button">Edit</button>
        </a>

        <form action="/products/{{ $p->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn-danger" onclick="return confirm('Delete?')">
                Delete
            </button>
        </form>

    </div>

</div>

@endforeach

</body>
</html>