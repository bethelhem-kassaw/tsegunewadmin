<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Api\paypalcontroller;
use App\Http\Controllers\Api\Stripe_payment_controller;
use App\Http\Controllers\Shopping\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\StakeholderPasswordResetController;
use App\Livewire\ShopComponent;
use App\Livewire\SingleProduct;
use App\Livewire\CartDetail;
use App\Livewire\CheckoutComponent;
use App\Livewire\WishlistConponent;
use App\Livewire\EditProfile;
use App\Models\Country;
use App\Models\CountryCity;
use Filament\Pages\Auth\Login;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

// Route::get('test', function () {
//     $f = fopen('/home/nesren/Downloads/allCountriesCSV.csv', 'r');

//     if ($f) {
//         $counter = 0;
//         // read each line in CSV file at a time
//         $first = fgetcsv($f);
//         $countryCodePre = '';
//         $country = null;
//         // $lim = set_time_limit(6000);

//         while (($row = fgetcsv($f)) !== false) {
//             // $countryCodeCurr = $row[0];
//             $counter++;

//             // if ($countryCodeCurr !=  $countryCodePre) {
//             //     $country = Country::where('country_code', $countryCodeCurr)->get();
//             // }
//             // foreach ($country as $c) {
//             //     $city = CountryCity::where('name', $row[2])->first();
//             //     if($city == null){
//             //         CountryCity::create([
//             //             'name' => $row[2],
//             //             'country_id' => $c->id,
//             //             'zipcode' => $row[1],
//             //         ]);
//             //     }
//             // }
//             // $countryCodePre = $countryCodeCurr;
//         }
//     }
//     fclose($f);

//     dd('Done Oyayayayayayyayaya  ' . $counter);
// });
// Route::get('paypal-success', [OrderController::class, 'receivePaypalPaymens'])->middleware('auth')->name('paypal.success');
// Route::get('card-success',  [OrderController::class, 'receiveCardPayments'])->middleware('auth')->name('card.success');
// Route::get('cancel-payments', [OrderController::class, 'cancelPaypalPayment'])->name('paypal.cancel');
// Route::get('order/confirmation/{tracking}', [OrderController::class, 'orderConfirm'])->name('shop.confirmation');

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('shop/list/{id?}', ShopComponent::class)->name('shop.list');
Route::get('shop/list/{main}/{id?}', ShopComponent::class)->name('shop.shop-sub-list');
Route::get('shop/product-single/{id?}', SingleProduct::class)->name('shop.product-single');
Route::get('shop/checkout', CheckoutComponent::class)->middleware('auth')->name('shop.checkout');
Route::get('cart/detail', CartDetail::class)->name('shop.cart');
Route::get('blogpost', [BlogPostController::class, 'customerPost'])->name('customer.blogpost');
Route::view('contact', 'customer-shop.contact')->name('shop.contact');
Route::view('commingsoon', 'customer-shop.comingSoon')->name('shop.comingSoon');

// Route::view('about', 'customer-shop.about')->name('shop.about');
Route::middleware('auth')->get('wishlist', WishlistConponent::class)->name('customer.wishlist');

// Route::view('privacy', 'policies.privacy');
// Route::view('terms', 'policies.terms');
// Route::view('disclaimer', 'policies.disclaimer');

// Route::controller(CustomerDashboardController::class)->middleware('auth')->prefix('customer/dashboard')->name('customer.dashboard.')->group(function () {
//     // Route::get('/', 'index')->name('index');
//     Route::get('order', 'order')->name('order');
//     Route::get('address', 'address')->name('address');
//     Route::get('profile', 'profile')->name('profile');
// });
// Route::get('customer/dashboard/edit-profile', EditProfile::class)->name('customer.dashboard.edit-profile');

// Route::get('/login', Login::class)->name('filament.admin.auth.login');
// Route::get('/logout', Login::class)->name('filament.admin.auth.logout');
Route::redirect('/', '/admin');
Route::view('paypal', 'paypal');
Route::view('stripe', 'paypal');


    Route::post('paypal', [paypalcontroller::class, 'pypaltest'])->name('paypaltest');
    Route::get('success', [paypalcontroller::class, 'success'])->name('success');
    Route::get('cancel', [paypalcontroller::class, 'cancel'])->name('cancel');


    Route::get('mailto', function () {
        Mail::to('michaelgetachew5@gmail.com')->send(new \App\Mail\TestMail());
       });

       Route::prefix('stakeholder')->group(function () {
        Route::get('forgot-password', [StakeholderPasswordResetController::class, 'showLinkRequestForm'])->name('stakeholder.password.request');
        Route::get('sendemil', [StakeholderPasswordResetController::class, 'sendResetLinkEmail'])->name('stakeholder.password.email');
        Route::get('reset-password/{token}', [StakeholderPasswordResetController::class, 'showResetForm'])->name('stakeholder.password.reset');
        Route::post('reset-password', [StakeholderPasswordResetController::class, 'reset'])->name('stakeholder.password.update');
    });


    Route::post('/create-payment-intent', [Stripe_payment_controller::class, 'createPaymentIntent']);

    Route::post('stripe', [Stripe_payment_controller::class, 'stripePayment'])->name('stripePayment');
    Route::get('success', [Stripe_payment_controller::class, 'success'])->name('success');
    Route::get('cancel', [Stripe_payment_controller::class, 'cancel'])->name('cancel');

