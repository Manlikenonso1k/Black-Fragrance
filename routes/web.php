<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    if (! Schema::hasTable('products')) {
        return view('pages.index', ['products' => collect()]);
    }

    return view('pages.index', [
        'products' => Product::query()->where('in_stock', true)->get(),
    ]);
})->name('home');

Route::view('/about', 'pages.about')->name('about');
Route::view('/blog', 'pages.blog')->name('blog');
Route::view('/contact', 'pages.contact')->name('contact');

// --- CART ROUTES ---
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/{cartItem}/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cartItem}/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// --- CHECKOUT ROUTES ---
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/order/{order}/success', [CheckoutController::class, 'success'])->name('order.success');

// --- PAYMENT ROUTES ---
Route::get('/checkout/pay/tgipay/{order}', [PaymentController::class, 'initiateTgiPay'])->name('payment.tgipay.initiate');
Route::any('/tgipay/callback', [PaymentController::class, 'tgiPayCallback'])
    ->name('tgipay.callback')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/webhooks/tgi', [PaymentController::class, 'tgiPayWebhook'])
    ->name('tgipay.webhook')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/shop', function () {
    if (! Schema::hasTable('products')) {
        return view('pages.shop', ['products' => collect()]);
    }

    $products = Product::all();
    return view('pages.shop', ['products' => $products]);
})->name('shop');

Route::get('/product', function () {
    if (! Schema::hasTable('products')) {
        return redirect()->route('shop')
            ->with('status', 'Products table is missing locally. Run php artisan migrate --seed.');
    }

    $product = Product::first();

    if (! $product) {
        return redirect()->route('shop')
            ->with('status', 'No products found. Run php artisan db:seed --class=Database\\Seeders\\ProductSeeder.');
    }

    return redirect()->route('product.show', $product);
});

// Dynamic product detail route using slug
Route::get('/product/{product}', function (Product $product) {
    return view('pages.product', ['product' => $product]);
})->name('product.show')->missing(function () {
    try {
        if (! Schema::hasTable('products')) {
            return redirect()->route('shop')
                ->with('status', 'Products table is missing locally. Run php artisan migrate --seed.');
        }
    } catch (QueryException) {
        return redirect()->route('shop')
            ->with('status', 'Local database is not ready yet. Run php artisan migrate --seed.');
    }

    return redirect()->route('shop');
});

Route::view('/single-post', 'pages.single-post')->name('single-post');
Route::view('/styles', 'pages.styles')->name('styles');
Route::view('/thank-you', 'pages.thank-you')->name('thank-you');
