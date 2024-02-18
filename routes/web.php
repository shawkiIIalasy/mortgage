<?php

use Illuminate\Support\Facades\Route;

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
Route::inertia('/', 'App')->name('home');
Route::inertia('/loans/{id}', 'Loans/Show')->name('views.loans.show');
Route::inertia('/loans/{id}/edit', 'Loans/Edit')->name('views.loans.edit');
Route::inertia('loans/{loan}/amortizations/{id}', 'Amortizations/Show')->name('views.amortizations.show');
Route::inertia('loans/{loan}/extra-payments/{id}', 'ExtraPayments/Show')->name('views.extra-payments.show');
