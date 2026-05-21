<!DOCTYPE html>
<html>
<head>
    <title>Edit Category - Inventory Gudang</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .card {
            max-width: 500px;
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

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #3498db;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
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

<h2>✏️ Edit Category</h2>

<form action="/categories/{{ $category->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Category</label>
    <input type="text" name="name" value="{{ $category->name }}" placeholder="Nama category">

    <button type="submit">Update Category</button>
</form>

<a class="back" href="/categories">← Kembali</a>

</div>

</body>
</html>