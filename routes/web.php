<?php

use App\Http\Controllers\Backend\AttributeGroupController;
use App\Http\Controllers\Backend\AttributeValueController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
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
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
