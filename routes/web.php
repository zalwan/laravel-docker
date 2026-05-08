<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/contents', [ContentController::class, 'index'])->name('contents');
Route::get('/contents/{content}', [ContentController::class, 'show'])->name('contents.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
