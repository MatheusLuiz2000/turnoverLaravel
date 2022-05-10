<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group([
    'middleware' => 'apiJwt:api',
    'prefix' => 'account'
], function ($router) {
    Route::get('/transactions', [TransactionsController::class, 'searchTransactions']);
    Route::get('/transactions/count', [TransactionsController::class, 'getTransactionsCount']);
    Route::get('/deposits', [DepositController::class, 'getDeposits']);
    Route::post('/purchase', [PurchaseController::class, 'addNewPurchase']);
    Route::post('/deposit', [DepositController::class, 'addNewDeposit']);
    Route::get('/deposit/pending', [DepositController::class, 'getDepositPending']);
    Route::post('/deposit/change', [DepositController::class, 'updateDeposit']);
    // Route::post('buy', '\App\Http\Controllers\Buys\BuysController@buyStore')->name('buy.store');
    // Route::get('deposit/pending', '\App\Http\Controllers\Deposits\DepositController@listPending')->name('deposit.pending');
    // Route::post('deposit/alter/status', '\App\Http\Controllers\Deposits\DepositController@alterStatusDeposit')->name('status.deposit');
    // Route::get('deposit/list', '\App\Http\Controllers\Deposits\DepositController@listLogBalance')->name('list.deposit');
    // Route::get('deposit/details/{id}', '\App\Http\Controllers\Deposits\DepositController@depositDetails')->name('deposit.details');
    // Route::post('me', 'AuthController@me');
});
