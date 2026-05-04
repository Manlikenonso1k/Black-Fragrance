<?php

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
Route::view('/cart', 'pages.cart')->name('cart');
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
