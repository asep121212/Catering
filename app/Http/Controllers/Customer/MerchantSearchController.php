<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantSearchController extends Controller
{
    public function index(Request $request)
{
    $query = Merchant::query();

    if ($request->keyword) {
        $query->where('company_name','like','%'.$request->keyword.'%');
    }

    $merchants = $query->with('menus')->paginate(10); 

    return view('customer.merchants.index', compact('merchants'));
}

public function show($id)
{
    $merchant = Merchant::with('menus')->findOrFail($id);
    return view('customer.merchants.show', compact('merchant'));
}
}