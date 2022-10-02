<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoanController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'loans', 'middleware' => 'auth', 'as' => 'loan.'], function () {
    Route::get('/', [LoanController::class, 'index'])->name('index');
    Route::post('/fetch', [LoanController::class, 'fetch'])->name('fetch');
    Route::post('/add', [LoanController::class, 'addLoan'])->name('add');
    Route::get('/download/{loan}', [LoanController::class, 'downloadFile'])->name('download');
});

Route::group(['prefix' => 'customers', 'middleware' => 'auth', 'as' => 'customer.'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::post('/fetch', [CustomerController::class, 'fetch'])->name('fetch');
    Route::get('/get/{customer}', [CustomerController::class, 'get'])->name('get');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
