<?php

use App\Http\Controllers\Admin\AUserController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CuponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\DishQuantities;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReferalController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ShippingZonesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;








Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::post('/set-currency', function (Request $request) {
    $currency = $request->currency;
    // Set country in the session after login
    session(['country' => auth()->user()->country]);
    // Store the selected currency in the session only
    Session::put('selected_currency', $currency);

    return response()->json(['success' => true, 'stored_currency' => Session::get('selected_currency')]);
})->name('set.currency');





Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Show email verification notice
Route::get('/email/verify', EmailVerificationPromptController::class)
    ->name('verification.notice');

// Handle verification link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/referrals', [UserDashboardController::class, 'referrals'])->name('referrals');
    Route::get('/order/histroy', [UserDashboardController::class, 'order_history'])->name('order.history');
    Route::put('/orders/{order}/cancel', [UserDashboardController::class, 'cancelOrder'])->name('orders.cancel');









    //cart routes
    Route::post('/add-to-cart', [UserOrderController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/cart', [UserOrderController::class, 'viewCart'])->name('user.cart');
    Route::delete('/cart/{id}', [UserOrderController::class, 'destroy'])->name('user.cart.destroy');
    Route::get('/cart-count', function () {
        $count = \App\Models\Order::where(
            [
                'user_id' => auth()->id(),
                'order_stage' => 'in_cart'
            ]
        )->count();
        return response()->json(['count' => $count]);
    });
    //cart routes

    //wishlists routes 
    Route::post('/wishlist/store', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::get('/get-wishlist-items', [WishlistController::class, 'getWishlistItems'])->name('get.wishlist.items');
    Route::delete('/delete-wishlist-item/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::get('/wishlist-count', function () {
        $count = \App\Models\WishlistItem::where('user_id', auth()->id())->count();
        return response()->json(['count' => $count]);
    });
    //wishlists routes 


    //checout routes and payment routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

    Route::post('/save-address', [CheckoutController::class, 'saveAddress'])->name('save.address');
    Route::post('/update-selected-address', [CheckoutController::class, 'updateSelectedAddress'])->name('update.selected.address');


    Route::get('/get-address/{id}', function ($id) {
        return response()->json(UserAddress::find($id));
    });

    Route::post('/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('apply.coupon');

    Route::get('/shipping', [CheckoutController::class, 'shipping'])->name('shipping.page');

    Route::post('/update-shipping-method', [CheckoutController::class, 'updateShippingMethod'])->name('update-shipping-method');

    Route::post('/razorpay/initiate', [RazorpayController::class, 'initiate'])->name('razorpay.initiate');
    Route::get('/razorpay/success', [RazorpayController::class, 'success'])->name('razorpay.success');

    Route::get('/order/confimartion', [UserOrderController::class, 'order_confirmation'])->name('order.confirmation');
    //checout routes and payment routes

});



Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('category', CategoriesController::class);
    Route::resource('dishes', DishController::class);
    Route::resource('quantity', DishQuantities::class);

    Route::resource('users', AUserController::class);
    Route::resource('/users.referrals', ReferalController::class)
        ->shallow();
    Route::resource('coupons', CuponController::class);

    Route::get('/orders/confirmed', [OrderController::class, 'confirmed'])->name('orders.confirmed');
    Route::get('/orders/processing', [OrderController::class, 'processing'])->name('orders.processing');
    Route::get('/orders/packing', [OrderController::class, 'packing'])->name('orders.packing');
    Route::get('/orders/shipped', [OrderController::class, 'shipped'])->name('orders.shipped');
    Route::get('/orders/completed', [OrderController::class, 'completed'])->name('orders.completed');
    Route::get('/orders/cancelled', [OrderController::class, 'cancelled'])->name('orders.cancelled');
    Route::get('/orders/returned', [OrderController::class, 'returned'])->name('orders.returned');

    // Payment-related routes
    Route::get('/orders/payment/pending', [OrderController::class, 'paymentPending'])->name('orders.payment.pending');
    Route::get('/orders/payment/processing', [OrderController::class, 'paymentProcessing'])->name('orders.payment.processing');
    Route::get('/orders/payment/failed', [OrderController::class, 'paymentFailed'])->name('orders.payment.failed');
    Route::get('/orders/payment/completed', [OrderController::class, 'paymentCompleted'])->name('orders.payment.completed');
    Route::get('/orders/payment/refunded', [OrderController::class, 'paymentRefunded'])->name('orders.payment.refunded');
    Route::get('/orders/payment/partially_refunded', [OrderController::class, 'paymentPartiallyRefunded'])->name('orders.payment.partially_refunded');
    Route::get('/orders/payment/chargeback', [OrderController::class, 'paymentChargeback'])->name('orders.payment.chargeback');
    Route::put('/admin/orders/{id}/update-status', [OrderController::class, 'updateOrderStatus'])->name('orders.update_status');
    Route::put('/admin/orders/{id}/update-payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.update_payment_status');


    Route::resource('orders', OrderController::class);
    Route::resource('settings', SettingsController::class);
    Route::resource('rewards', RewardController::class);
    Route::resource('shipping_zones', ShippingZonesController::class);


});


require __DIR__ . '/auth.php';
