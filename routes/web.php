<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
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

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('profile', CompanyProfileController::class)->except(['show']);
    Route::resource('articles', ArticleController::class)->except(['show']);
});
