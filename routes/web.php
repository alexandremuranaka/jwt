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
die('web');

Route::domain('app.bymeds.com.br')->group(function(){
  Route::get('/', function(){
    echo "hohoho";
    //return view('admin.entrar');
  });

  //Route::resource('/admin','AdminController');
  //
  // Route::get('/', 'AdminController@index' );
  // Route::get('/signin', 'AdminController@signin' );
  // Route::get('/cadastrar', 'AdminController@cadastrar');
  // Route::post('/cadastrar/store', 'AdminController@store');
  // Route::get('/recover', 'AdminController@recover');
  // Route::get('/admin', 'AdminController@dash');
});




Route::domain('api.bymeds.com.br')->group(function(){
  Route::get('/', function(){
    return view('api.index');
  });

});
