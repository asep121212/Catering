@extends('layouts.customer')

@section('title', 'Dashboard Customer')
@section('header', 'Dashboard Customer')

@section('content')
<div class="space-y-10">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100">
            <p class="text-sm text-gray-500 mb-1">Total Order</p>
            <p class="text-3xl font-bold text-indigo-600">
                {{ $totalOrders ?? 0 }}
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100">
            <p class="text-sm text-gray-500 mb-1">Total Belanja</p>
            <p class="text-3xl font-bold text-green-600">
                Rp {{ number_format($totalSpent ?? 0) }}
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100">
            <p class="text-sm text-gray-500 mb-1">Sedang Diproses</p>
            <p class="text-3xl font-bold text-yellow-500">
                {{ $processingOrders ?? 0 }}
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100">
            <p class="text-sm text-gray-500 mb-1">Order Selesai</p>
            <p class="text-3xl font-bold text-blue-600">
                {{ $completedOrders ?? 0 }}
            </p>
        </div>

    </div>

    <div class="bg-white shadow-sm rounded-xl border border-gray-100">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Order Terakhir</h3>
        </div>

        <div class="divide-y">
            @forelse($recentOrders ?? [] as $order)
            <div class="p-4 flex justify-between items-center">
                <div>
                    <p class="font-medium">#{{ $order->id }}</p>
                    <p class="text-sm text-gray-500">
                        {{ $order->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="text-right">
                    <p class="font-semibold">
                        Rp {{ number_format($order->total_price) }}
                    </p>

                    <span class="text-xs px-2 py-1 rounded-full
                            @if($order->status === 'completed') bg-green-100 text-green-600
                            @elseif($order->status === 'processing') bg-yellow-100 text-yellow-600
                            @elseif($order->status === 'cancelled') bg-red-100 text-red-600
                            @else bg-gray-100 text-gray-600
                            @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
            @empty
            <div class="p-6 text-center text-gray-500">
                Belum ada order.
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection