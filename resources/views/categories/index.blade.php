<!DOCTYPE html>
<html>
<head>
    <title>Inventory Gudang - Categories</title>

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

        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 15px;
        }

        input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-right: 5px;
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

        .btn-edit {
            background: #2ecc71;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .actions {
            display: flex;
            gap: 5px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h2 class="title">📂 Inventory Gudang - Categories</h2>

{{-- ================= CREATE ================= --}}
<div class="card">

<h3>➕ Tambah Category</h3>

<form action="/categories" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama category">
    <button class="btn-primary" type="submit">Simpan</button>
</form>

</div>

{{-- ================= LIST ================= --}}
<h3>📋 List Categories</h3>

@foreach($categories as $c)

<div class="card row">

    <div>
        <b>{{ $c->name }}</b>
    </div>

    <div class="actions">

        <a href="{{ route('categories.edit', $c->id) }}">
            <button class="btn-edit" type="button">Edit</button>
        </a>

        <form action="/categories/{{ $c->id }}" method="POST">
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