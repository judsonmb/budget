<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrowserController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CustomerController;

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

Route::get('/browsers', [BrowserController::class, 'getBrowsers']);

Route::get('/customers', [CustomerController::class, 'getCustomers']);

Route::post('/budget/step/one', [BudgetController::class, 'storeStepOne']);

Route::post('/budget/step/two', [BudgetController::class, 'storeStepTwo']);
