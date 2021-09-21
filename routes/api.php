<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [ RegisterController::class, "register" ])->name('register');
Route::post('/login', [ LoginController::class, "login" ])->name('login');
Route::middleware('auth:api', function () {
       Route::post('/logout', [ LoginController::class, "logout" ])->name('logout');
});

// Route::middleware('auth:api')->group(['as' => 'user.' , 'prefix' => 'user'], function () {

// });
