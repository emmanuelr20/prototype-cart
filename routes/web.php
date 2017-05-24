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

Route::get('products', 'ProductController@index');

Route::post('addtocart/{product}', 'ProductController@addToCart');
Route::get('clearcart', 'ProductController@clear');
Route::get('viewcart', 'ProductController@viewCart');
Route::get('removeitem/{item}', 'ProductController@removeFromCart');
Route::post('updateqty/{item}', 'ProductController@updateCart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
