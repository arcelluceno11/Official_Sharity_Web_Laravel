<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\TestController;

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
    return redirect('test');
});

Route::resource('/admin', AdminController::class);
Route::resource('/charity', CharityController::class);
Route::resource('/donation', DonationController::class);
Route::resource('/test', TestController::class);

