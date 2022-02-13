<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(["middleware" => ['api','api_key', 'api.language']] ,function(){

   Route::namespace('Auth')->group(function(){

       Route::post('register', 'RegisterController@register')->name('register');
       Route::post('login', 'LoginController@login')->name('login');

       Route::group(['middleware' => ['auth.guard:api-customer']] ,function(){
           Route::get('profile', 'ProfileController@profile')->name('profile');
           Route::post('logout', 'LogoutController@logout')->name('logout');
       });

   });// End namespace Auth
// Category Route

    Route::get('categories', 'CategoryController@index')->name('categories');
    Route::get('category/{id}/places', 'PlaceController@index')->name('category.places');
});
