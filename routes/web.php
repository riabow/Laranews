<?php

use Illuminate\Support\Facades\Auth;

// Получить текущего аутентифицированного пользователя...
$user = Auth::user();


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
    global $user;
    #return view('welcome');
    return view('app',['user'=>$user]);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/list', 'NewsController@index');
Route::get('/ndel/{id}', 'NewsController@ndel');
Route::get('/nedit/{id}', 'NewsController@nedit');
Route::post('/nupdate/{id}', 'NewsController@nupdate');
Route::get('/nnew', 'NewsController@nnew');
Route::post('/nadd', 'NewsController@nadd');
Route::get('/searchform', 'NewsController@searchform');
Route::post('/search', 'NewsController@search');
