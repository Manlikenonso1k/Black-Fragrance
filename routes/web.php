<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});

Route::view('/index.html', 'pages.index');
Route::view('/about', 'pages.about');
Route::view('/about.html', 'pages.about');
Route::view('/blog', 'pages.blog');
Route::view('/blog.html', 'pages.blog');
Route::view('/contact', 'pages.contact');
Route::view('/contact.html', 'pages.contact');
Route::get('/shop', function () {
    $products = Product::all();
    return view('pages.shop', ['products' => $products]);
});

Route::get('/product', function () {
    $product = Product::first();

    abort_if(! $product, 404);

    return redirect()->route('product.show', $product);
});

// Dynamic product detail route using slug
Route::get('/product/{product}', function (Product $product) {
    return view('pages.product', ['product' => $product]);
})->name('product.show');

Route::view('/single-post', 'pages.single-post');
Route::view('/single-post.html', 'pages.single-post');
Route::view('/styles', 'pages.styles');
Route::view('/styles.html', 'pages.styles');
Route::view('/thank-you', 'pages.thank-you');
Route::view('/thank-you.html', 'pages.thank-you');
