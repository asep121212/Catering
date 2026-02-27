@extends('layouts.merchant')

@section('title', 'Edit Menu')
@section('header', 'Edit Menu')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-lg">

    <form action="{{ route('merchant.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data"
        class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Nama Menu</label>
            <input type="text" name="name" value="{{ $menu->name }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2"
                rows="3">{{ $menu->description }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Jenis Menu</label>
            <select name="type" class="w-full border rounded px-3 py-2">
                <option value="">Pilih jenis</option>
                <option value="makanan" {{ $menu->type=='makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="minuman" {{ $menu->type=='minuman' ? 'selected' : '' }}>Minuman</option>
                <option value="lainnya" {{ $menu->type=='lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Harga</label>
            <input type="number" name="price" value="{{ $menu->price }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Foto Menu</label>

            @if($menu->photo)
            <img src="{{ asset('storage/'.$menu->photo) }}" class="w-24 h-24 object-cover rounded mb-2">
            @endif

            <input type="file" name="photo" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Update
        </button>
    </form>

</div>
@endsection