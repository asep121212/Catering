@extends('layouts.customer')

@section('title', 'Order Saya')
@section('header', 'Order Saya')

@section('content')

<h2 class="text-2xl font-bold mb-6">Daftar Order Saya</h2>

@if(session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4 text-left">Invoice</th>
                    <th class="px-6 py-4 text-left">Total</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Tanggal Kirim</th>
                    <th class="px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $order->invoice->invoice_number ?? '-' }}
                    </td>
                    <td class="px-6 py-4 font-semibold text-green-600">
                        Rp {{ number_format($order->total_price) }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium
                            @if($order->status === 'pending') bg-yellow-100 text-yellow-700
                            @elseif($order->status === 'completed') bg-green-100 text-green-700
                            @elseif($order->status === 'cancelled') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-600
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ \Carbon\Carbon::parse($order->delivery_date)->format('d-m-Y') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($order->invoice)
                        <a href="{{ route('customer.orders.download', $order->id) }}"
                            class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700">
                            Download Invoice
                        </a>
                        @else
                        <span class="text-gray-400 text-sm">Belum ada invoice</span>
                        @endif
                    </td>
                </tr>

                @if($order->invoice)
                <tr class="bg-gray-50">
                    <td colspan="5" class="px-6 py-4">
                        @include('customer.orders.invoice', ['order' => $order])
                    </td>
                </tr>
                @endif

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection