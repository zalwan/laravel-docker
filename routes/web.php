<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');


Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::redirect('/admin', '/admin/projects')->name('admin');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('projects/pdf', [AdminProjectController::class, 'pdf'])->name('projects.pdf');
    Route::resource('projects', AdminProjectController::class)->except(['show']);
});
