<?php

use App\Http\Controllers\API\V1\CustomerController;
use App\Http\Controllers\API\V1\LoanController;
use App\Http\Middleware\VerifyAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'middleware' => VerifyAPI::class, 'namespace' => 'API\V1', 'as' => 'api.v1.'], function () {

    Route::group(['prefix' => 'loan', 'as' => 'loans.'], function () {
        Route::post('/', [LoanController::class, 'index'])->name('index');
        Route::post('/add', [LoanController::class, 'add'])->name('add');
        Route::post('/get/{id}', [LoanController::class, 'get'])->name('get');
    });

    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::post('/', [CustomerController::class, 'index'])->name('index');
        Route::post('/add', [CustomerController::class, 'add'])->name('add');
        Route::post('/get/{id}', [CustomerController::class, 'get'])->name('get');
    });
});
