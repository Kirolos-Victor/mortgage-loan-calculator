<?php

use App\Http\Controllers\Frontend\AmortizationController;
use App\Http\Controllers\Frontend\ExtraRepaymentController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', function () {
    return redirect()->route('loan-amortization-calculator');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('loan-amortization-calculator', [AmortizationController::class, 'index'])
            ->name('loan-amortization-calculator');
    Route::post('loan-amortization-calculator', [AmortizationController::class, 'store'])
            ->name('store-loan-amortization-calculator');
    Route::get('extra-repayment-calculator', [ExtraRepaymentController::class, 'index'])
            ->name('extra-repayment-calculator');
    Route::post('extra-repayment-calculator', [ExtraRepaymentController::class, 'store'])
            ->name('store-extra-repayment-calculator');
});