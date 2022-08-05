<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api as Api;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('xendit/va/list', [Api\Payment\XenditController::class, 'getlistVa']);
// Route::post('xendit/va/invoice', [Api\Payment\XenditController::class, 'createVa'])->name('api.createVa');
Route::get('xendit/va/invoice/detail/{va}', [Api\Payment\XenditController::class, 'invoice_va'])->name('api.invoiceVa');
Route::post('xendit/va/callback', [Api\Payment\XenditController::class, 'callbackVa']);

Route::get('xendit/payment_channel/list', [Api\Payment\XenditController::class, 'getlistchannel']);

Route::post('xendit/credit_card/charge', [Api\Payment\XenditController::class, 'creditcard'])->name('api.creditcard');
