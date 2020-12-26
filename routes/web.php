<?php

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

Route::get('/', 'ProductController@show')->name('home');



Route::get('register', 'UserController@register')->middleware('login');
Route::post('register', 'UserController@store');

Route::get('/login','UserController@loginPage')->middleware('login');
Route::post('/login','UserController@login');

Route::get('admin', 'UserController@admin')->middleware('admin');


Route::group(['prefix' => 'admin'], function () {

    Route::get('addproduct', 'CategoryController@addprod')->middleware('admin');

    Route::post('addproduct', 'ProductController@store')->middleware('admin');
    Route::get('listproduct', 'CategoryController@product')->middleware('admin');
    Route::delete('listproduct/{id}', 'ProductController@destroy')->middleware('admin');

    Route::get('addcategory', 'CategoryController@addcategory')->middleware('admin');
    Route::post('addcategory', 'CategoryController@store')->middleware('admin');
    Route::get('listcategory', 'CategoryController@category')->middleware('admin');
    Route::get('listcategory/{id}', 'CategoryController@category')->middleware('admin');
});

Route::get('/home', 'ProductController@show')->name('home');
Route::get('/product_detail/{id}', 'ProductController@detail')->middleware('user');
Route::get('/addToCart/{id}', 'ProductController@cart')->middleware('user');
Route::post('/addToCart/{id}', 'ProductController@addToCart')->middleware('user');
Route::get('/product/search', 'ProductController@search');
Route::get('/cart', 'ProductController@viewCart')->middleware('user');
Route::post('/cart/edit/{id}', 'ProductController@editCart')->middleware('user');
Route::get('/cart/delete/{id}', 'ProductController@deleteCart')->middleware('user');
Route::get('/process', 'ProductController@Checkout');


Route::get('/history', 'ProductController@history')->middleware('user');
Route::get('/historyDetail/{id}', 'ProductController@historyDetail')->middleware('user');


Route::get('/logout', 'UserController@logout')->middleware('user');
