<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>

<h1>Edit Category</h1>

<form action="/categories/{{ $category->id }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $category->name }}" placeholder="Nama category">

    <button type="submit">Update</button>
</form>

<br>

<a href="/categories">Kembali</a>

</body>
</html>