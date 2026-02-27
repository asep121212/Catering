<h2 class="font-bold mb-2">INVOICE</h2>

<p>No Invoice: {{ $order->invoice->invoice_number }}</p>
<p>Merchant: {{ $order->merchant->name }}</p>
<p>Customer: {{ $order->customer->name }}</p>

<hr class="my-2">

@foreach($order->items as $item)
<p>
    {{ $item->menu->name }} -
    {{ $item->quantity }} x Rp {{ number_format($item->price) }}
    = Rp {{ number_format($item->subtotal) }}
</p>
@endforeach

<hr class="my-2">

<h3>Total: Rp {{ number_format($order->total_price) }}</h3>