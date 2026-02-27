<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class MerchantDashboardController extends Controller
{
    public function index()
    {
        $merchantId = Auth::id();

        $orderQuery = Order::where('merchant_id', $merchantId);

        $totalOrders = $orderQuery->count();

        $totalRevenue = Order::where('merchant_id', $merchantId)
            ->where('status', 'completed')
            ->sum('total_price');

        $processingOrders = Order::where('merchant_id', $merchantId)
            ->where('status', 'processing')
            ->count();

        $completedOrders = Order::where('merchant_id', $merchantId)
            ->where('status', 'completed')
            ->count();

        $cancelledOrders = Order::where('merchant_id', $merchantId)
            ->where('status', 'cancelled')
            ->count();

        $recentOrders = Order::where('merchant_id', $merchantId)
            ->latest()
            ->take(5)
            ->get();

        $totalMenus = Auth::user()->menus()->count();

        return view('merchant.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'processingOrders',
            'completedOrders',
            'cancelledOrders',
            'recentOrders',
            'totalMenus'
        ));
    }
}