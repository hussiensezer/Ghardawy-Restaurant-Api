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

Route::get("dashboard/login", "Auth\LoginController@login")->name("dashboard.login");
Route::post("dashboard/loginProcess", "Auth\LoginController@loginProcess")->name("dashboard.loginProcess");

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){


    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth:admins'])->group(function(){
        Route::post("logout", 'Auth\LogoutController@logout')->name('logout');
        Route::get('home' ,'HomeController@home')->name('home');
        Route::post('send', 'HomeController@send')->name('send');
        //Route::Categories
        Route::resource('categories', 'CategoryController');

        // Route::Places
        Route::resource('places', 'PlaceController');

        // Route::Menu Of Places
        Route::get('place/{id}/menu/create', 'MenuController@create')->name('place.menu.create');
        Route::post('place/{id}/menu/store', 'MenuController@store')->name('place.menu.store');

        //Route::Categories Of Menu
        Route::get('place/{id}/category/index', 'MenuCategoryController@index')->name('place.category.index');
        Route::get('place/{id}/category/create', 'MenuCategoryController@create')->name('place.category.create');
        Route::post('place/{id}/category/store', 'MenuCategoryController@store')->name('place.category.store');
        Route::put('place/{id}/category/{category}/update', 'MenuCategoryController@update')->name('place.category.update');

        // Route::Sizes
        Route::resource('sizes', 'SizeController');
    });

});
