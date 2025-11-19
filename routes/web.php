<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ProductList;
use App\Livewire\ProductDetail;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\OrderList;
use App\Livewire\AccountSettings;
use App\Livewire\Seller\ProductCreate;
use App\Livewire\Seller\ProductEdit;
use App\Livewire\Seller\ProductList as SellerProductList;
use App\Http\Controllers\AuthController;

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Products
Route::get('/products', ProductList::class)->name('products.index');
Route::get('/products/{productId}', ProductDetail::class)->name('products.show');

// Cart
Route::get('/cart', Cart::class)->name('cart.index');

// Checkout (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/orders', OrderList::class)->name('orders.index');
    Route::get('/orders/{orderId}', function ($orderId) {
        return view('orders.show', ['orderId' => $orderId]);
    })->name('orders.show');
    
    // Payment simulation routes
    Route::get('/payment/transfer/{order}', [\App\Http\Controllers\PaymentController::class, 'transfer'])->name('payment.transfer');
    Route::get('/payment/e-wallet/{order}', [\App\Http\Controllers\PaymentController::class, 'eWallet'])->name('payment.e_wallet');
    Route::post('/payment/{order}/confirm', [\App\Http\Controllers\PaymentController::class, 'confirmPayment'])->name('payment.confirm');
    
    // Account Settings
    Route::get('/settings/account', function () {
        return view('settings.account');
    })->name('settings.account');
    Route::patch('/settings/account', [AccountSettings::class, 'updateProfile'])->name('settings.account.update');
    
    // Seller Routes (Only for sellers)
    Route::middleware('seller')->prefix('seller')->name('seller.')->group(function () {
        Route::get('/products', function () {
            return view('seller.products.index');
        })->name('products.index');
        Route::get('/products/create', function () {
            return view('seller.products.create');
        })->name('products.create');
        Route::post('/products', [ProductCreate::class, 'createProduct'])->name('products.store');
        Route::get('/products/{productId}/edit', function ($productId) {
            return view('seller.products.edit', ['productId' => $productId]);
        })->name('products.edit');
        Route::patch('/products/{productId}', [ProductEdit::class, 'updateProduct'])->name('products.update');
        Route::delete('/products/{productId}', [SellerProductList::class, 'deleteProduct'])->name('products.destroy');
    });
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

