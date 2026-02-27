@extends('layouts.merchant')

@section('title', 'Daftar Menu')
@section('header', 'Daftar Menu')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Menu Anda</h2>

        <a href="{{ route('merchant.menus.create') }}"
            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            + Tambah Menu
        </a>
    </div>

    {{-- Search & Filter --}}
    <form method="GET" class="flex gap-2 mb-4">
        <input type="text" name="search" placeholder="Cari nama menu..." value="{{ request('search') }}"
            class="flex-1 border border-gray-300 rounded px-3 py-2">

        <select name="type" class="border border-gray-300 rounded px-3 py-2">
            <option value="">Semua jenis</option>
            <option value="makanan" {{ request('type')=='makanan' ? 'selected' : '' }}>Makanan</option>
            <option value="minuman" {{ request('type')=='minuman' ? 'selected' : '' }}>Minuman</option>
            <option value="lainnya" {{ request('type')=='lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Filter
        </button>
    </form>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif

    @if($menus->isEmpty())
    <p class="text-gray-500">Belum ada menu.</p>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Foto</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Jenis</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Harga</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($menus as $menu)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">
                        @if($menu->photo)
                        <img src="{{ asset('storage/'.$menu->photo) }}" class="w-16 h-16 object-cover rounded">
                        @else
                        <span class="text-gray-400 text-sm">Tidak ada</span>
                        @endif
                    </td>

                    <td class="px-4 py-3 font-medium">{{ $menu->name }}</td>
                    <td class="px-4 py-3 font-medium text-gray-600">{{ ucfirst($menu->type ?? '-') }}</td>
                    <td class="px-4 py-3 text-green-600 font-semibold">Rp {{ number_format($menu->price) }}</td>

                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('merchant.menus.edit', $menu->id) }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                            Edit
                        </a>

                        <form action="{{ route('merchant.menus.destroy', $menu->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>
@endsection