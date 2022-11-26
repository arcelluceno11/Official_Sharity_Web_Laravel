<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

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
    return redirect('/login');
});


Route::middleware(['preventBackHistory'])->group(function () {

    //Login Controller
    Route::resource('/login', LoginController::class);
    Route::post('/login/signIn', [LoginController::class, 'signIn']);

    //Donation Controller
    Route::resource('/donation', DonationController::class);
    Route::post('/donation/acceptDonation/{id}', [DonationController::class, 'acceptDonation']);
    Route::post('/donation/rejectDonation/{id}', [DonationController::class, 'rejectDonation']);
    Route::post('/donation/assignDriver/{taskid}', [DonationController::class, 'assignDriver']);
    Route::post('/donation/qualityCheckedPiece/{id}', [DonationController::class, 'qualityCheckedPiece']);
    Route::post('/donation/qualityCheckedBulk/{id}', [DonationController::class, 'qualityCheckedBulk']);

    //Purchase Controller
    Route::resource('/purchase', PurchaseController::class);
    Route::post('/purchase/acceptPurchase/{id}', [PurchaseController::class, 'acceptPurchase']);

    Route::resource('/admin', AdminController::class);
    Route::resource('/charity', CharityController::class);
    Route::resource('/donor', DonorController::class);
    Route::resource('/driver', DriverController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/transaction', TransactionController::class);
});
