<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/activeCarousel', [CarouselController::class, 'activeCarousel']);

Route::group(
    ['middleware' => ['throttle:api', 'auth:api', 'role:Administrador']],
    function () {
        Route::resource('/order', OrderController::class);
    }
);

Route::group(
    ['middleware' => ['throttle:api', 'auth:api']],
    function () {
        Route::post('/userInfo', fn () => request()->user());

        Route::get('/myOrder', [OrderController::class, 'myOrder']);

        //Admin
        Route::resource('/carousel', CarouselController::class);
        Route::resource('/order', OrderController::class);
        Route::post('/order/changeState', [OrderController::class, 'changeState']);
        Route::resource('/user', UserController::class);
        Route::put('/updateUser/{id}', [UserController::class, 'updateUser']);
        Route::resource('/state', StateController::class);
        Route::resource('/store', StoreController::class);
        Route::resource('/localization', LocalizationController::class);
        Route::resource('/role', RoleController::class);
    }
);

Route::group(
    ['middleware' => ['throttle:api']],
    function () {
        Route::get('/status', fn () => response()->json(["message" => "Active"]));

        Route::get('/epcom/{any}', [ProductController::class, 'gateway'])->where('any', '.*');
        Route::post('/epcom/{any}', [ProductController::class, 'gateway'])->where('any', '.*');
        Route::put('/epcom/{any}', [ProductController::class, 'gateway'])->where('any', '.*');
        Route::delete('/epcom/{any}', [ProductController::class, 'gateway'])->where('any', '.*');

        Route::post('/notification/email', [NotificationController::class, 'sendEmail']);
    }
);
