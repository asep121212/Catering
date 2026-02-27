@extends('layouts.customer')

@section('title', 'Menu Katering')
@section('header', 'Menu Katering')

@section('content')
<div class="max-w-7xl mx-auto px-4">

    <h2 class="text-2xl font-bold mb-6">Daftar Menu Catering</h2>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    <form method="GET" action="{{ route('customer.menus.index') }}" class="mb-6 flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama menu..."
            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">

        <select name="type" class="border border-gray-300 rounded-lg px-4 py-2">
            <option value="">Semua jenis</option>
            <option value="makanan" {{ request('type')=='makanan' ? 'selected' : '' }}>Makanan</option>
            <option value="minuman" {{ request('type')=='minuman' ? 'selected' : '' }}>Minuman</option>
            <option value="lainnya" {{ request('type')=='lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>

        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
            Cari
        </button>
    </form>

    @if($menus->isEmpty())
    <div class="bg-white p-6 rounded-xl shadow text-center text-gray-500">
        Menu tidak ditemukan.
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($menus as $menu)
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition">

            @if($menu->photo)
            <img src="{{ asset('storage/'.$menu->photo) }}" class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                Tidak ada foto
            </div>
            @endif

            <div class="p-5">
                <h3 class="text-lg font-semibold text-gray-800">{{ $menu->name }}</h3>
                <p class="text-sm text-gray-500 mb-2">Oleh: {{ $menu->merchant->name }}</p>
                <p class="text-sm text-gray-400 mb-2 font-medium">Jenis: {{ ucfirst($menu->type ?? '-') }}</p>
                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $menu->description }}</p>
                <p class="text-indigo-600 font-bold text-lg mb-4">Rp {{ number_format($menu->price) }}</p>

                <form action="{{ route('customer.order.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                    <div class="flex gap-2">
                        <input type="number" name="quantity" min="1" required placeholder="Qty"
                            class="w-20 border border-gray-300 rounded-lg px-3 py-2">

                        <input type="date" name="delivery_date" required
                            class="flex-1 border border-gray-300 rounded-lg px-3 py-2" min="{{ date('Y-m-d') }}">
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                        Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $menus->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection