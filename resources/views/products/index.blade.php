<!DOCTYPE html>
<html>
<head>
    <title>Products CRUD</title>
</head>
<body>

<h1>Products (1 Page CRUD)</h1>

{{-- ================= SEARCH & FILTER ================= --}}
<form method="GET" action="/products" style="margin-bottom:20px;">

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

    <button type="submit">Filter</button>

    <a href="/products">Reset</a>
</form>

<hr>

{{-- ================= CREATE PRODUCT ================= --}}
<h3>Tambah Product</h3>

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

    <button type="submit">Simpan</button>
</form>

<hr>

{{-- ================= LIST PRODUCT ================= --}}
<h3>List Products</h3>

@foreach($products as $p)

    {{-- UPDATE --}}
    <form action="/products/{{ $p->id }}" method="POST" enctype="multipart/form-data" style="margin-bottom:10px;">
        @csrf
        @method('PUT')

        <select name="category_id">
            @foreach($categories as $c)
                <option value="{{ $c->id }}"
                    {{ $p->category_id == $c->id ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>

        <input type="text" name="name" value="{{ $p->name }}">
        <input type="text" name="sku" value="{{ $p->sku }}">
        <input type="number" name="stock" value="{{ $p->stock }}">
        <input type="number" name="price" value="{{ $p->price }}">
        <input type="file" name="image">

        <button type="submit">Update</button>
    </form>

    {{-- IMAGE --}}
    @if($p->image)
        <img src="{{ asset('storage/products/' . $p->image) }}" width="80">
    @endif

    {{-- DELETE --}}
    <form action="/products/{{ $p->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Delete?')">Delete</button>
    </form>

    <hr>

@endforeach

</body>
</html>