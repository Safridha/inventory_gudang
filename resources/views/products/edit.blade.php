<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

<h1>Edit Product</h1>

<form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <select name="category_id">
        @foreach($categories as $c)
            <option value="{{ $c->id }}"
                {{ $product->category_id == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
        @endforeach
    </select>

    <input type="text" name="name" value="{{ $product->name }}">
    <input type="text" name="sku" value="{{ $product->sku }}">
    <input type="number" name="stock" value="{{ $product->stock }}">
    <input type="number" name="price" value="{{ $product->price }}">

    <input type="file" name="image">

    @if($product->image)
        <br>
        <img src="{{ asset('storage/products/' . $product->image) }}" width="100">
    @endif

    <br><br>

    <button type="submit">Update</button>
</form>

<br>

<a href="/products">Back</a>

</body>
</html>