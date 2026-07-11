<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/product/{id}', [GalleryController::class, 'showProduct'])->name('gallery.product');
Route::get('/artist/{id}', [GalleryController::class, 'showArtist'])->name('gallery.artist');

Route::get('/artisans', function () {
    $artists = \App\Models\Artist::with('products')->get();
    return view('pages.artisans', compact('artists'));
})->name('pages.artisans');

Route::get('/svlk-check', function (Request $request) {
    $query = $request->input('q');
    $product = null;
    if ($query) {
        $product = \App\Models\Product::where('svlk_certificate_number', $query)->first();
    }
    return view('pages.svlk', compact('query', 'product'));
})->name('pages.svlk');

Route::get('/about', function () {
    return view('pages.about');
})->name('pages.about');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{id}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{id}', [AdminController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{id}', [AdminController::class, 'destroy'])->name('admin.products.destroy');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');
