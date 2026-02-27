<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
  
    public function index()
    {
        $orders = Order::with('invoice', 'items.menu', 'merchant')
            ->where('customer_id', auth()->id())
            ->latest()
            ->get();

        return view('customer.orders.index', compact('orders'));
    }

 
    public function menuList(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');

        $menus = Menu::with('merchant')
            ->when($search, fn($query) => $query->where('name', 'like', "%{$search}%"))
            ->when($type, fn($query) => $query->where('type', $type))
            ->paginate(9);

        return view('customer.menus.index', compact('menus'));
    }

   
    public function downloadInvoice(Order $order)
    {
        if ($order->customer_id !== auth()->id()) {
            abort(403);
        }

        $order->load('invoice', 'items.menu', 'merchant');

        $pdf = Pdf::loadView('customer.orders.invoice', compact('order'));

        return $pdf->download($order->invoice->invoice_number . '.pdf');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'delivery_date' => 'required|date|after_or_equal:today'
        ]);

        $deliveryDate = $request->delivery_date;
        if ($deliveryDate < now()->toDateString()) {
            return back()->with('error', 'Tanggal pengiriman harus hari ini atau lebih.');
        }

        $menu = Menu::findOrFail($request->menu_id);
        $subtotal = $menu->price * $request->quantity;

        $order = Order::create([
            'customer_id' => auth()->id(),
            'merchant_id' => $menu->merchant_id,
            'total_price' => 0, 
            'status' => 'pending',
            'delivery_date' => $deliveryDate
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'price' => $menu->price,
            'subtotal' => $subtotal
        ]);

        $order->total_price = $order->items()->sum('subtotal');
        $order->save();

        $today = now()->format('Ymd');
        $countToday = Invoice::whereDate('created_at', now())->count() + 1;
        $invoiceNumber = 'INV-' . $today . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);

        Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => $invoiceNumber,
            'total_amount' => $order->total_price,
            'issued_at' => now()
        ]);

        return redirect()->route('customer.orders.index')
            ->with('success', 'Pesanan & Invoice berhasil dibuat');
    }
}