<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
 
    public function index()
    {
        $orders = Order::with(['invoice', 'items.menu', 'customer'])
            ->where('merchant_id', auth()->id())
            ->latest()
            ->get();

        return view('merchant.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if ($order->merchant_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah order ini.');
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ], [
            'status.in' => 'Status yang dipilih tidak valid.'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status order berhasil diperbarui.');
    }
}