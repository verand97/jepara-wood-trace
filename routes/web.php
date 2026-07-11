<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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

Route::get('/login', function () {
    return 'Laman Login (Segera Hadir)';
})->name('login');

Route::get('/register', function () {
    return 'Laman Register (Segera Hadir)';
})->name('register');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');
