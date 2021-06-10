<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/customers', ['uses' => App\Http\Controllers\CustomerManagement\Customers\GetCustomersController::class]);
Route::post('/customers', ['uses' => App\Http\Controllers\CustomerManagement\Customers\CreateCustomerController::class]);
Route::put('/customers/{id}', ['uses' => App\Http\Controllers\CustomerManagement\Customers\UpdateCustomerController::class]);
