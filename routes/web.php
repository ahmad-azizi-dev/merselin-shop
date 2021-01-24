<?php

use App\Http\Controllers\Backend\AttributeGroupController;
use App\Http\Controllers\Backend\AttributeValueController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\LoginByPhoneTokenController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserProfileController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendCategoryController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\MyOrdersController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Backend\SlideController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MainController;
use App\Http\Controllers\Backend\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['web', 'Local'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('login', [AuthController::class, 'login'])->name('frontendLogin');
    Route::post('login', [AuthController::class, 'postLoginNumber'])->name('postLoginNumber');
    Route::get('otp-confirm/{loginByPhone}', [AuthController::class, 'otpConfirm'])->name('otpConfirm');
    Route::post('otp-confirm', [AuthController::class, 'postOtpConfirm'])->name('postOtpConfirm');
    Route::post('logout', [AuthController::class, 'logout'])->name('frontendLogout');

    Route::get('product/{slug}', [FrontendProductController::class, 'show'])->name('showProduct');
    Route::get('category/{category}', [FrontendCategoryController::class, 'show'])->name('showCategory');

    Route::middleware(['auth'])->group(function () {
        Route::get('profile', [ProfileController::class, 'show'])->name('profile');
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('editProfile');
        Route::post('profile', [ProfileController::class, 'update'])->name('updateProfile');
        Route::get('checkout', [CheckoutController::class, 'show'])->name('checkout');
        Route::post('checkout', [CheckoutController::class, 'postCheckout'])->name('postCheckout');
        Route::get('checkout/payment', [CheckoutController::class, 'checkoutPayment'])->name('checkoutPayment');
        Route::post('credit-card-payment', [PaymentController::class, 'creditCard'])->name('creditCardPayment');
        Route::get('credit-card-payment', [PaymentController::class, 'showCreditCard'])->name('showCreditCardPayment');
        Route::get('my-orders', [MyOrdersController::class, 'show'])->name('showMyOrders');
        Route::post('my-orders/cancel', [MyOrdersController::class, 'cancelOrder'])->name('cancelOrder');
    });
});


Route::prefix('administrator')->middleware(['web', 'auth', 'Local'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin');
    Route::resource('categories', CategoryController::class);
    Route::get('/categories/{id}/settings', [CategoryController::class, 'indexSetting'])->name('categories.indexSetting');
    Route::post('/categories/{id}/settings', [CategoryController::class, 'saveSetting'])->name('categories.saveSetting');

    Route::resource('attributes-group', AttributeGroupController::class);
    Route::resource('attributes-value', AttributeValueController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('medias', MediaController::class);
    Route::post('medias/upload', [MediaController::class, 'upload'])->name('medias.upload');
    Route::resource('products', ProductController::class);
    Route::get('slides', [SlideController::class, 'index'])->name('slides');
    Route::get('loginByPhoneToken', [LoginByPhoneTokenController::class, 'index'])->name('loginByPhoneToken');
    Route::get('user-profile', [UserProfileController::class, 'index'])->name('userProfile');
    Route::get('all-users', [UserController::class, 'index'])->name('allUsers');
    Route::get('roles', [RoleController::class, 'index'])->name('roles');



//    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');

});

Route::redirect('/adm/login', '/administrator/login');
