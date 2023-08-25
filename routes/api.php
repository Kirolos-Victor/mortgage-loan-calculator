<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MortgageLoanController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/calculate-amortization', [MortgageLoanController::class, 'calculateAmortization']);
    Route::post('/calculate-extra-repayment-schedule', [MortgageLoanController::class, 'calculateExtraRepaymentSchedule']);
});
