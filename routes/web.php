<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('home.index');
})->name('home');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/create', [BlogController::class, 'create'])->name( 'blog.create');
Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{blog}/comment', [BlogController::class, 'storeComment'])->name('blog.comment.store');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/order', [OrderController::class, 'index'])->name('order');

Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

// Cart routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/get', [CartController::class, 'get'])->name('cart.get'); // New route
Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove'); // New route
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::put('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');

Route::get('/checkout', [OrderController::class, 'checkout_form'])->name('checkout');
Route::post('/order/process-checkout', [OrderController::class, 'store'])->name('order.processCheckout');
Route::get('/order/success/{order}', [OrderController::class, 'success'])->name('order.success');
