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

use App\Http\Controllers\CharityListController;
use App\Http\Controllers\DonorListController;
use App\Http\Controllers\TransactionListController;
use App\Http\Controllers\ReviewListController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
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
    return redirect('/login');
});


Route::middleware(['preventBackHistory'])->group(function () {

    //Login Controller
    Route::resource('/login', LoginController::class);
    Route::post('/login/signIn', [LoginController::class, 'signIn']);

    //Profile
    Route::resource('/profile',ProfileController::class);

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
    Route::post('/purchase/rejectPurchase/{id}', [PurchaseController::class, 'rejectDonation']);
    Route::post('/purchase/assignDriver/{taskid}', [PurchaseController::class, 'assignDriver']);

    //Charity Controller
    Route::put('/charity/editApptDate/{id}', [CharityController::class, 'editApptDate']);
    Route::post('/charity/editListed/{id}', [CharityController::class, 'editListed']);
    Route::get('send-mail', [CharityController::class, 'update']);

    //Driver Controller
    Route::get('send-mail', [DriverController::class, 'store']);

    Route::resource('/admin', AdminController::class);
    Route::resource('/charity', CharityController::class);
    Route::resource('/donor', DonorController::class);
    Route::resource('/driver', DriverController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/transaction', TransactionController::class);
    Route::resource('/sales', SalesController::class);
    Route::resource('/history', HistoryController::class);
    Route::resource('/charitylist', CharityListController::class);
    Route::resource('/donorshopperlist', DonorListController::class);
    Route::resource('/transactionlist', TransactionListController::class);
    Route::resource('/reviewlist', ReviewListController::class);
});
