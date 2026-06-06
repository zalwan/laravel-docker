<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Api\SwaggerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');


Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/api/docs', [SwaggerController::class, 'index'])->name('api.docs');
    Route::get('/api/openapi.json', [SwaggerController::class, 'openapi'])->name('api.openapi');
});

Route::redirect('/admin', '/admin/projects')
    ->middleware('auth')
    ->name('admin');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('projects/pdf', [AdminProjectController::class, 'pdf'])->name('projects.pdf');
    Route::resource('projects', AdminProjectController::class)->except(['show']);
});
