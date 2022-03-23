<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mock Routes
|--------------------------------------------------------------------------
|
| These are routes used for mocking apis during integration tests
|
*/

Route::group(['prefix' => 'sap'], function () {
    Route::post('SalesTaxInvoices', [\App\Http\Controllers\Mock\SapController::class, 'createInvoice']);
});
