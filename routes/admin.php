<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\Admin\AuthenticatedSessionController;

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'],function() {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'],function(){
    Route::get('dashboard',[AdminDashboardController::class,'index'])->name('dashboard');
    Route::post('logout',[AuthenticatedSessionController::class,'destroy'])->name('logout');
});
