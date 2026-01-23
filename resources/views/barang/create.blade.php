<x-app-layout>
    <form method="POST" action="{{ route('barang.store') }}">
        @csrf
        <input name="nama_barang" placeholder="Nama"><br>
        <input name="harga" placeholder="Harga"><br>
        <input name="stok" placeholder="Stok"><br>
        <input name="diskon" placeholder="Diskon (%)"><br>
        <button type="submit">
            Simpan
        </button>
    </form>
</x-app-layout>