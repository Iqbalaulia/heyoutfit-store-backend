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

Route::get('/' , 'DashboardController@index')->name('dashboard')->middleware('auth');

// Dissable register laravel
Auth::routes(['register' => false]);

Route::resource('products','ProductController')->middleware('auth');
Route::get('products/{id}/gallery','ProductController@gallery')->name('products.gallery')->middleware('auth');

Route::resource('product-galleries','ProductGalleryController')->middleware('auth');