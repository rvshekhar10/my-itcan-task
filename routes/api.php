<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\UserListController;

Route::get('/users', [UserController::class, 'fetchUsers']);



Route::put('coupons/{coupon}/redeem', [CouponController::class, 'redeem']);
Route::post('coupons/redeem', [CouponController::class, 'redeemWebhook']);


Route::get('/coupons' , [CouponController::class, 'index']);
Route::prefix('/coupon')->group( function(){
    Route::post('/store' , [CouponController::class, 'store']);
    Route::put('/{id}' , [CouponController::class, 'update']);
    Route::destroy('/{id}' , [CouponController::class, 'destroy']);
    }
);


