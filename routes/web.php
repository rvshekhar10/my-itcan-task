<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->resource('coupons', CouponController::class);
