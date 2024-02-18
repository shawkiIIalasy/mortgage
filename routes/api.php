<?php

use App\Http\Controllers\Api\V0\LoanAmortizationController;
use App\Http\Controllers\Api\V0\LoanController;
use App\Http\Controllers\Api\V0\LoanExtraPaymentController;
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

Route::prefix('v0')->group(function () {
    Route::apiResource('loans', LoanController::class);
    Route::apiResource('loans/{loan}/amortizations', LoanAmortizationController::class)->only('index', 'show');
    Route::apiResource('loans/{loan}/extra-payments', LoanExtraPaymentController::class)->only('index', 'show');
    Route::post('loans/{loan}/extra-payments/{id}', [LoanExtraPaymentController::class, 'pay']);

});
