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
   Route::get('/dashboard/profile/', 'DashboardController@edit');
   Route::post('/dashboard/profile/update', 'DashboardController@update');
   Route::post('/dashboard/profile/updatepass', 'DashboardController@updatepass');
   Route::get('/dashboard/bymedspay/', 'BymedspayController@procedurelist');
   Route::get('/dashboard/bymedspay/hospital', 'BymedspayController@hospital');
   Route::post('/dashboard/bymedspay/hospital', 'BymedspayController@hospitalselected');
   Route::get('/dashboard/bymedspay/my-register', 'BymedspayController@myregister');
   Route::get('/dashboard/bymedspay/register', 'BymedspayController@register');
   Route::post('/dashboard/bymedspay/register', 'BymedspayController@registerstore');
   Route::get('/dashboard/bymedspay/register/{id}/show', 'BymedspayController@registershow');
   Route::get('/dashboard/bymedspay/register/{id}/edit', 'BymedspayController@registeredit');
   Route::post('/dashboard/bymedspay/register/{id}/update', 'BymedspayController@registerupdate');
   Route::post('/dashboard/bymedspay/register/favorite/{id}/update', 'BymedspayController@registerfavoriteupdate');
   Route::get('/dashboard/bymedspay/register-all', 'BymedspayController@registerall');



});




Route::domain('api.bymeds.com.br')->group(function(){
  Route::get('/', function(){
    return view('api.index');
  });

});
