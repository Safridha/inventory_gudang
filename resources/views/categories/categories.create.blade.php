<h1>Create Category</h1>

<form method="POST" action="/categories">
    @csrf
    <input type="text" name="name" placeholder="Category name">
    <button>Simpan</button>
</form>