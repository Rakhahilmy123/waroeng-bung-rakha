<x-app-layout>
    <form method="POST" action="{{ route('barang.update', $barang) }}">
        @csrf @method('PUT')
        <input name="nama_barang" value="{{ $barang->nama_barang }}"><br>
        <input name="harga" value="{{ $barang->harga }}"><br>
        <input name="stok" value="{{ $barang->stok }}"><br>
        <input name="diskon" value="{{ $barang->diskon }}"><br>
        <button type="submit">Update</button>
    </form>
</x-app-layout>
