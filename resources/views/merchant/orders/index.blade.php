@extends('layouts.merchant')

@section('title', 'Order Masuk')
@section('header', 'Order Masuk')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <h2 class="text-xl font-bold mb-4">Daftar Pesanan</h2>

    @if($orders->isEmpty())
    <div class="text-gray-500">
        Belum ada pesanan masuk.
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Invoice</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Customer</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Update</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-sm">
                        {{ $order->invoice->invoice_number ?? '-' }}
                    </td>

                    <td class="px-4 py-3 text-sm">
                        {{ $order->customer->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3 text-sm font-semibold text-gray-700">
                        Rp {{ number_format($order->total_price) }}
                    </td>

                    <td class="px-4 py-3 text-sm">
                        @if($order->status == 'pending')
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            Pending
                        </span>
                        @elseif($order->status == 'confirmed')
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                            Confirmed
                        </span>
                        @else
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            Completed
                        </span>
                        @endif
                    </td>

                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('merchant.orders.updateStatus', $order->id) }}"
                            class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')

                            <select name="status"
                                class="border border-gray-300 rounded px-2 py-1 text-sm focus:ring focus:ring-indigo-200">
                                <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                                <option value="confirmed" {{ $order->status=='confirmed'?'selected':'' }}>Confirmed
                                </option>
                                <option value="completed" {{ $order->status=='completed'?'selected':'' }}>Completed
                                </option>
                            </select>

                            <button type="submit"
                                class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700 transition">
                                Update
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