<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::domain('api.bymeds.com.br')->group(function () {
  Route::post('/auth/register', 'UserController@register');
  Route::post('/auth/login', 'UserController@login');



  Route::group(['middleware' => 'jwt.auth'], function () {
      Route::get('user', 'UserController@getAuthUser');
      Route::post('/auth/hospital', 'HospitalController@hospitalList');
      Route::post('/auth/tuss/{tuss}/show', 'TussController@tusslList');
      Route::post('/auth/tuss', 'TussController@tusslList');
      Route::post('/auth/procedures/{id}/list', 'ProcedureController@procedureList');
      Route::post('/auth/procedures/store', 'ProcedureController@store');
  });

});
