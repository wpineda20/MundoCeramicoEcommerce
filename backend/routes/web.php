<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/edit', fn () => view('users.edit'));

    Route::post('/users/{id}', [UserController::class, 'update'])->name('user.update');
});

Route::get('/status', fn () => response()->json(["message" => "Active"]));

Auth::routes();
