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
Route::get('addproducts', 'ProductController@View');

Route::post('addtocart/{product}', 'CartController@addToCart');
Route::get('clearcart', 'CartController@clear');
Route::get('viewcart', 'CartController@viewCart');
Route::post('removeitem/{item}', 'CartController@removeFromCart');
Route::post('updateqty/{item}', 'CartController@updateCart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/products', 'ProductController@adminView')->name('admin_product');
    Route::post('/addproducts', 'ProductController@create')->name('addproduct');
    Route::get('/edit/{product}', 'ProductController@getEdit')->name('editProductView');
    Route::post('/edit/{product}', 'ProductController@postEdit')->name('editProductView');
    Route::post('/delete/{product}', 'ProductController@delete')->name('delete');
    //Route::post('/editproducts', 'ProductController@create');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});