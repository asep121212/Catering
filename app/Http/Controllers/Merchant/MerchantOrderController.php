<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class MerchantOrderController extends Controller
{
    public function index()
    {
        $merchant = Auth::user()->merchant;

        $orders = Order::where('merchant_id',$merchant->id)->with('invoice')->get();

        return view('merchant.orders.index', compact('orders'));
    }
}