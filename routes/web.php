<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Merchant\MenuController;
use App\Http\Controllers\Merchant\OrderController as MerchantOrderController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Merchant\MerchantDashboardController;


Route::get('/', function () {

    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');

});



Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'merchant') {
        return redirect()->route('merchant.dashboard');
    }

    if ($user->role === 'customer') {
        return redirect()->route('customer.dashboard');
    }

    abort(403);
})->name('dashboard');



Route::middleware('auth')->get('/redirect-role', function () {

    $user = auth()->user();

    if ($user->role === 'merchant') {
        return redirect()->route('merchant.dashboard');
    }

    if ($user->role === 'customer') {
        return redirect()->route('customer.dashboard');
    }

    abort(403);

})->name('redirect.role');



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});



Route::middleware(['auth', 'role:merchant'])
    ->prefix('merchant')
    ->name('merchant.')
    ->group(function () {

     Route::get('/dashboard', [MerchantDashboardController::class, 'index'])
    ->name('dashboard');

        Route::get('orders', [MerchantOrderController::class, 'index'])
            ->name('orders.index');

        Route::patch('orders/{order}/status',
            [MerchantOrderController::class, 'updateStatus']
        )->name('orders.updateStatus');

        Route::resource('menus', MenuController::class);

    });



Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

      Route::get('/dashboard', [CustomerDashboardController::class, 'index'])
    ->name('dashboard');
    Route::get('orders/{order}/download', [OrderController::class, 'downloadInvoice'])
        ->name('orders.download');
        Route::get('orders/{order}/invoice',
            [OrderController::class,'downloadInvoice']
        )->name('invoice.download');

     Route::get('menus', [OrderController::class, 'menuList'])
    ->name('menus.index');

        Route::post('order-now', [OrderController::class, 'store'])
            ->name('order.store');

        Route::resource('orders', OrderController::class);

    });

require __DIR__.'/auth.php';