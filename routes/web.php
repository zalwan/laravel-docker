<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\ArticlePublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GalleryPublicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductPublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/about', '/profile')->name('about');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::redirect('/services', '/products')->name('services');
Route::get('/products', [ProductPublicController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductPublicController::class, 'show'])->name('products.show');
Route::get('/articles', [ArticlePublicController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticlePublicController::class, 'show'])->name('articles.show');
Route::get('/gallery', [GalleryPublicController::class, 'index'])->name('gallery.index');
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
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('gallery', GalleryController::class)->except(['show']);
    Route::get('reports/project-summary.pdf', [ReportController::class, 'export'])->name('reports.export');
});
