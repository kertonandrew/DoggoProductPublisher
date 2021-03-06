<?php

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

// Source data from DogApi
Route::get('dogBreeds', 'DogApiController@extractAllAndStore');
Route::get('dogBreeds/{count}', 'DogApiController@extractAllAndStore');

// Shopify Product routes
Route::get('dogProducts', 'ShopifyApiController@index');
Route::post('dogProducts', 'ShopifyApiController@store');
