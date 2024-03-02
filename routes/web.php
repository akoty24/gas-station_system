<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\Front\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function()
    {

            Auth::routes();
            Route::get('/' , [ShiftController::class,'shift_day'])->name('shift_day');
            Route::resource('shifts', ShiftController::class);
            Route::resource('devices', DeviceController::class);
            Route::resource('deposits', DepositController::class);
        });