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

// Route::get('/', function () {
//     return view('test');
// });
Route::get('/','invoiceController@index');
Route::post('/store-invoice','invoiceController@store_invoice');
Route::post('/view-product-info','invoiceController@view_product_info');
Route::get('/view-invoice','invoiceController@view_invoice');