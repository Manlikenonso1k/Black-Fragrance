<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::view('/about', 'pages.about')->name('about');
Route::view('/blog', 'pages.blog')->name('blog');
Route::view('/contact', 'pages.contact')->name('contact');
Route::get('/shop', function () {
    $products = Product::all();
    return view('pages.shop', ['products' => $products]);
})->name('shop');

Route::get('/product', function () {
    $product = Product::first();

    abort_if(! $product, 404);

    return redirect()->route('product.show', $product);
});

// Dynamic product detail route using slug
Route::get('/product/{product}', function (Product $product) {
    return view('pages.product', ['product' => $product]);
})->name('product.show');

Route::view('/single-post', 'pages.single-post')->name('single-post');
Route::view('/styles', 'pages.styles')->name('styles');
Route::view('/thank-you', 'pages.thank-you')->name('thank-you');
