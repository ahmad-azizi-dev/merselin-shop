<?php

use App\Http\Controllers\Backend\AttributeGroupController;
use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MainController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('administrator')->middleware(['web'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin');
    Route::resource('categories', CategoryController::class);
    Route::resource('attributes-group', AttributeGroupController::class);
});
