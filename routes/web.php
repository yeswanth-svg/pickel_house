<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CuponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cart', [OrderController::class, 'viewCart'])->name('user.cart');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('category', CategoriesController::class);
    Route::resource('dishes', DishController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('coupons', CuponController::class);

});


require __DIR__ . '/auth.php';
