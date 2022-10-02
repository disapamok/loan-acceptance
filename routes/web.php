<?php

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
    Route::put('/add', [LoanController::class, 'addLoan'])->name('add');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
