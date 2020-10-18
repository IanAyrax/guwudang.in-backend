<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('product', 'App\Http\Controllers\ProductController');
/*
Route::get('product','App\Http\Controllers\ProductController@index');
Route::post('product','App\Http\Controllers\ProductController@create');
Route::put('product','App\Http\Controllers\ProductController@update');
Route::delete('product','App\Http\Controllers\ProductController@destroy');
*/

Route::get('/partner', 'PartnerController@index');
Route::get('/partner/search','PartnerController@search');
Route::get('/partner/proses','PartnerController@proses');
Route::get('/partner/create','PartnerController@create');

Route::get('/orderItems', 'OrderItemsController@index');
Route::get('/orderItems/delete','OrderItemsController@delete');
Route::get('/orderItems/update','OrderItemsController@update');
Route::get('/partner/create','OrderItemsController@create');



