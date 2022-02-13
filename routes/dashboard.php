<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::get("dashboard/login", "Auth\LoginController@login")->name("dashboard.login");
    Route::post("dashboard/loginProcess", "Auth\LoginController@loginProcess")->name("dashboard.loginProcess");

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth:admins'])->group(function(){
        Route::post("logout", 'Auth\LogoutController@logout')->name('logout');
        Route::get('home' ,'HomeController@home')->name('home');

        //Route::Categories
        Route::resource('categories', 'CategoryController');

        // Route::Places
        Route::resource('places', 'PlaceController');
    });

});
