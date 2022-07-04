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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/contacts', 'ContactsController@index')->name('contacts');
Route::get('/products/{category}', 'ProductController@showCategory')->name('showCategory');
Route::get('/products/{category}/{product}', 'ProductController@show')->name('showProduct');
Route::get('/cart', 'CartController@index')->name('cartIndex');
Route::get('/clear-cart', 'CartController@clearCart')->name('clearCart');
Route::get('/cart/checkout', 'CheckoutController@index')->name('checkout');
Route::get('/cart/checkout/success', 'CheckoutController@addOrder')->name('placeOrder');

Route::post('/add-to-cart', 'CartController@addToCart')->name('addToCart');
