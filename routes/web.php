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


Route::domain('app.bymeds.com.br')->group(function(){

  Route::get('/', function(){return view('admin.index');})->name('login');
  Route::post('/', 'AdminController@login');
  Route::get('/register', function(){return view('admin.register');})->name('register');
  Route::post('/register', 'AdminController@register');
  Route::get('/recover', function(){return view('admin.recover');})->name('recover');
  Route::post('/recover', 'AdminController@recover');
  Route::post('/logout', 'AdminController@logout');


   Route::get('/dashboard', 'DashboardController@index');
  // Route::post('/dashboard/logout', 'AdminController@logout');
  // Route::get('/dashboard/register', 'AdminController@register');
  // Route::post('/dashboard/register/store', 'AdminController@store');
  // Route::get('/dashboard/recover', 'AdminController@recover');
  // Route::post('/dashboard/recover', 'AdminController@recovermail');


});




Route::domain('api.bymeds.com.br')->group(function(){
  Route::get('/', function(){
    return view('api.index');
  });

});
