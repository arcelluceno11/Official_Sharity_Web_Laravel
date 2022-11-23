<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

use App\Http\Controllers\CharityListController;
use App\Http\Controllers\DonorListController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\TransactionListController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SalesController;

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
    return redirect('donor');
});

Route::resource('/test', TestController::class);
Route::resource('/admin', AdminController::class);
Route::resource('/charity', CharityController::class);
Route::resource('/donation', DonationController::class);
Route::resource('/donor', DonorController::class);
Route::resource('/driver', DriverController::class);
Route::resource('/purchase', PurchaseController::class);
Route::resource('/product', ProductController::class);
Route::resource('/transaction', TransactionController::class);

Route::resource('/charitylist', CharityListController::class);
Route::resource('/donorshopperlist', DonorListController::class);
Route::resource('/orderlist', OrderListController::class);
Route::resource('/transactionlist', TransactionListController::class);
Route::resource('/history', HistoryController::class);
Route::resource('/sales', SalesController::class);
