<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\Admin\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

//--------------------------------Authentication Routes-------------------------------------------//
Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'],function() {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});
Route::post('admin/logout',[AuthenticatedSessionController::class,'destroy'])
    ->name('admin.logout')->middleware('auth:admin');
//------------------------------End Authentication Routes-----------------------------------------//


//------------------------------Dashboard Routes-----------------------------------------//
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'],function(){
    Route::get('dashboard',[AdminDashboardController::class,'index'])->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    Route::post('upload/image','ImageController@store')->name('image.store');
    Route::post('delete/image','ImageController@destroy')->name('image.destroy');
});
//----------------------------End Dashboard Routes---------------------------------------//
