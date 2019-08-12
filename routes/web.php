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

// Web
Route::get('/categoria', function () {
    return view('categoria');
});

Route::get('/producto', function () {
    return view('producto');
});

Route::get('/orden', function () {
    return view('orden');
});

// API
Route::group(['prefix'=>'api'],function(){

  Route::post('Categoria/add','API\CategoriaController@add');
  Route::get('Categoria/list','API\CategoriaController@list');
  Route::get('Categoria/disponible','API\CategoriaController@avalaible');
  Route::post('Categoria/change-status','API\CategoriaController@change_status');

  // producto
  Route::post('Producto/create','API\ProductoController@create');
  // list all product
  Route::get('Producto/list','API\ProductoController@list');
  // change status product
  Route::post('Producto/change-status','API\ProductoController@change_status');
  // product visible for POS
  Route::get('Producto/visible','API\ProductoController@visible');
  // crear orden y pedido 
  Route::post('Orden/create','API\OrdenController@create_order');

});
