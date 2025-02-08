<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CuponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\DishQuantities;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
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
    Route::post('/add-to-cart', [UserOrderController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/cart', [UserOrderController::class, 'viewCart'])->name('user.cart');
    Route::delete('/cart/{id}', [UserOrderController::class, 'destroy'])->name('user.cart.destroy');
    Route::get('/cart-count', function () {
        $count = \App\Models\Order::where(
            [
                'user_id' => auth()->id(),
                'status' => 'Incart'
            ]
        )->count();
        return response()->json(['count' => $count]);
    });

    Route::post('/address/add', [UserController::class, 'addAddress'])->name('user.address.add');
    Route::post('/address/edit', [UserController::class, 'editAddress'])->name('user.address.edit');
    Route::post('/address/select', [UserController::class, 'selectAddress'])->name('address.select');

    Route::post('/apply-coupon', [UserOrderController::class, 'applyCoupon'])->name('user.applyCoupon');
    Route::post('/checkout', [UserOrderController::class, 'checkout'])->name('user.checkout');

    Route::get('/order-confirmation', [UserOrderController::class, 'order_confirmation'])->name('order-confirmation');


    Route::post('/wishlist/store', [WishlistController::class, 'store'])->name('wishlist.store');

    Route::get('/get-wishlist-items', [WishlistController::class, 'getWishlistItems'])->name('get.wishlist.items');
    Route::delete('/delete-wishlist-item/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::get('/wishlist-count', function () {
        $count = \App\Models\WishlistItem::where('user_id', auth()->id())->count();
        return response()->json(['count' => $count]);
    });


});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('category', CategoriesController::class);
    Route::resource('dishes', DishController::class);
    Route::resource('quantity', DishQuantities::class);
    Route::resource('orders', OrderController::class);
    Route::resource('coupons', CuponController::class);

});


require __DIR__ . '/auth.php';
