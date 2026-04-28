<?php

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
Route::view('/shop', 'pages.shop');
Route::view('/shop.html', 'pages.shop');
Route::view('/product', 'pages.product');
Route::view('/product.html', 'pages.product');
Route::view('/single-post', 'pages.single-post');
Route::view('/single-post.html', 'pages.single-post');
Route::view('/styles', 'pages.styles');
Route::view('/styles.html', 'pages.styles');
Route::view('/thank-you', 'pages.thank-you');
Route::view('/thank-you.html', 'pages.thank-you');
