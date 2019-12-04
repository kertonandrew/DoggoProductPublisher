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

// Todo: Get dog breeds route
Route::get('dogBreeds', 'DogApiController@extractAllAndStore');
Route::get('dogBreeds/{breed}', 'DogApiController@extractBreedAndStore');

// Todo: Get products route
Route::post('dogProducts', 'ShopifyApiController@index');


