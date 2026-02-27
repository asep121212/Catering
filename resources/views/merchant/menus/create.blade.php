@extends('layouts.merchant')

@section('title', 'Tambah Menu')
@section('header', 'Tambah Menu')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg">

    <form action="{{ route('merchant.menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Nama Menu</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200"
                rows="3"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Jenis Menu</label>
            <select name="type" class="w-full border rounded px-3 py-2">
                <option value="">Pilih jenis</option>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Harga</label>
            <input type="number" name="price" class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-200"
                required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Foto Menu</label>
            <input type="file" name="photo" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Simpan
        </button>
    </form>

</div>
@endsection