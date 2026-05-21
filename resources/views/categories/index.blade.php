<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>

{{-- CREATE --}}
<h3>Tambah Category</h3>
<form action="/categories" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama category">
    <button type="submit">Simpan</button>
</form>

<hr>

{{-- LIST --}}
<h3>List Categories</h3>

@foreach($categories as $c)

    <input type="text" value="{{ $c->name }}" readonly>

    {{-- 🔥 INI REPLACE BUTTON UPDATE --}}
    <a href="{{ route('categories.edit', $c->id) }}">
        <button type="button">Update</button>
    </a>

    {{-- DELETE --}}
    <form action="/categories/{{ $c->id }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button>Delete</button>
    </form>

    <hr>

@endforeach

</body>
</html>