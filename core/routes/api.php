<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Stripe_payment_controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api')->group(function () {

    // Authentication apis
    Route::namespace('Auth')->group(function () {
        Route::post('request-otp-code-phone', 'VerificationController@sendOtp');
        Route::post('verify-phone-before-register', 'VerificationController@verifyPhoneBefore');
        Route::post('register', 'RegisterController@register');
        Route::post('login', 'LoginController@login');
        Route::post('request-reset-password-code-email', 'VerificationController@sendResetCode');
        Route::post('request-reset-password-code-phone', 'VerificationController@sendOtp');
        Route::post('verify-phone-or-email-before-reset', 'VerificationController@verifyBeforeReset');
        Route::post('reset-password', 'VerificationController@resetPassword');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('change-password', 'LoginController@changePassword')->name('change-password');
            Route::post('request-verify-code-email', 'VerificationController@sendVerifyEmail');
            Route::post('request-verify-code-phone', 'VerificationController@sendVerifyPhone');
            Route::post('verify-phone', 'VerificationController@verifyPhone');
            Route::post('verify-email', 'VerificationController@verifyEmail');
        //     Route::post('verify-landlord-request', 'VerificationController@verifyLandlord');
            Route::post('logout', 'LoginController@logout');
        });
    });

    Route::controller('ProfileController')->middleware('auth:sanctum')->group(function () {
Route::get('userprofile', 'userprofile');
    });

    // Product apis
    Route::controller('ProductController')->group(function () {
        Route::get('all-products', 'allProducts');
        Route::get('list-products', 'allProductsforfilter');
        Route::get('product-detail/{id}', 'productDetail');
        Route::get('product-by-category-grouped', 'productByCategory');
        Route::get('all-categories', 'mainCategories');
        Route::get('sliders', 'sliders');
        Route::get('special-offers', 'specialOffers');
        Route::get('featured-Products', 'featuredProducts');
        Route::get('topSelling-Products', 'topSellingProducts');
        Route::get('package-Products', 'packageProducts');
    });

    // Cart apis
    Route::controller('CartController')->middleware(['api'])->group(function(){
        Route::get('my-cart-list', 'myCart');
        Route::post('add-to-cart', 'addToCart');
        Route::post('remove-from-cart/{id}', 'removeCart');
        Route::post('clear-cart', 'clearCart');

        Route::get('my-favorites', 'myFavorites');
        Route::post('add-to-favorite/{productId}', 'addToFavorite');
        Route::post('remove-from-favorite/{favoriteId}', 'removeFavorite');
        Route::post('clear-favorite', 'clearFavorite');
        Route::post('from-favorite-to-cart/{favoriteId}', 'favToCart');
    });


    // Order apis
    Route::controller('OrderController')->middleware(['api'])->group(function(){
        Route::post('create-order', 'placeOrder');
        Route::get('my-orders', 'myOrders');
        // Route::get('order-detail/{orderId}', 'orderDetail');
    });


    // routes/api.php
Route::get('/orders/{order}/status', function ($orderId) {
    $order = Order::where('orderId', $orderId)->first();

    if (!$order) {
        return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
    }

    return response()->json(['status' => $order->status]);
});
    Route::controller('paypalcontroller')->middleware(['api'])->group(function(){
        Route::post('paypal-payment', 'pypaltest');
        Route::post('paypal-card', 'cardPayment');

        // Route::get('my-orders', 'myOrders');
        // Route::get('order-detail/{orderId}', 'orderDetail');
    });

    // Shippment address

    Route::controller('AddressController')->group(function(){
        Route::get('countries', 'countries');
        Route::get('country-cities/{countryId}', 'countryCities');
        Route::get('subcity/{cityId}', 'subcity');

    });
    Route::controller('AddressController')->middleware('auth:sanctum')->group(function(){

        Route::get('my-addresses', 'myAddress');
        Route::post('add-address', 'addNewAddress');
        Route::post('remove-address/{adressId}', 'removeAddress');
    });
});


Route::post('/create-payment-stripe', [Stripe_payment_controller::class, 'stripePayment']);



