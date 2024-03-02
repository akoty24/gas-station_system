<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\WebsiteInfoController;
use App\Http\Controllers\Admin\WorkerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ShiftController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{

    // All Routes Here..
    Route::group(['prefix' => 'admin'] , function(){
        // Auth Routes ...
        Route::get('/login' , [AdminAuthController::class , 'login'])->name('admin.login')->middleware('RedirectIfAuthAdmin');
        Route::post('/doLogin' , [AdminAuthController::class , 'doLogin'])->name('admin.doLogin');
        Route::any('/logout' , [AdminAuthController::class , 'logout'])->name('admin.logout');
        // Reset Password Routes ..
        Route::get('/forgot/password' , [AdminAuthController::class , 'forgot_password'])->name('admin.forgot_password');
        Route::post('/forgot/password/post' , [AdminAuthController::class , 'forgot_password_post'])->name('admin.forgot_password_post');
        Route::get('/reset/password/{token}' , [AdminAuthController::class , 'reset_password'])->name('admin.reset_password');
        Route::post('/reset/password/post/{token}' , [AdminAuthController::class , 'reset_password_post'])->name('admin.reset_password_post');
    
        // Start Authenticated Routes .... ...
        Route::group(['middleware' => 'admin'] , function(){
            
            // Dashboard Route ..
            Route::get('/dashboard' , [AdminAuthController::class,'index'])->name('admin.index');
            
            // Profile Routes ..
            Route::get('/profile' , [AdminProfileController::class,'index'])->name('admin.profile');
            Route::post('profile/update' , [AdminProfileController::class,'update'])->name('admin.profile.update');
            
            
            // Settings Routes ..
           

            // Admins Routes ..
            Route::group(['prefix' => 'admins'], function(){
                Route::get('/' , [AdminController::class,'index'])->name('admin.admins.index');
                Route::get('/create' , [AdminController::class,'create'])->name('admin.admins.create');
                Route::post('/store' , [AdminController::class,'store'])->name('admin.admins.store');
                Route::get('/show/{admin}' , [AdminController::class,'show'])->name('admin.admins.show');
                Route::get('/edit/{admin}' , [AdminController::class,'edit'])->name('admin.admins.edit');
                Route::put('/update/{admin}' , [AdminController::class,'update'])->name('admin.admins.update');
                Route::delete('/destroy/{admin}' , [AdminController::class,'destroy'])->name('admin.admins.destroy');
                Route::get('/activation/{admin}' , [AdminController::class,'activation'])->name('admin.admins.activation');
            });
            

          

        });
        // End Authenticated Routes ....
    
    });




});


