<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $customerId = auth()->id();

        $totalOrders = Order::where('customer_id', $customerId)->count();
        $totalSpent = Order::where('customer_id', $customerId)->sum('total_price');

        $menus = Menu::with('merchant')->get();

        $orders = Order::with('invoice')->where('customer_id', $customerId)
            ->latest()
            ->get();

        return view('customer.dashboard', compact('totalOrders','totalSpent','menus','orders'));
    }
}