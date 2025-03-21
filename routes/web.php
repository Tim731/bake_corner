<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MenuController;


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
