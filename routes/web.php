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
/*Route::get('/', function () {
    return view('welcome');
});*/
use Illuminate\Support\Facades\Route;

Route::get('/','App\Http\Controllers\WelcomeController@index');

Route::get('/console', 'App\Http\Controllers\FormController@getConsole');

Route::post('/console/response', 'App\Http\Controllers\FormController@consoleResponse');

Route::post('/result-delete', 'App\Http\Controllers\FormController@deleteResponse');

//Route::get('/login', 'FormController@login');

Route::get('about', 'App\Http\Controllers\GreetingController@getAbout');

Route::get('link', 'LinkController@link');

//Authファサードを通じて、ログイン関連のルーティングをおこなっている
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

/*ajaxでbookのデータ取得*/
Route::any('/ajax_getData_by_id','App\Http\Controllers\FormController@bookGetAjaxById');

/*ajaxでbookの登録*/
Route::any('/ajaxbookadd','App\Http\Controllers\FormController@bookAddAjax');

/*ajaxでcellの更新*/
Route::any('/ajaxupdate','App\Http\Controllers\FormController@cellUpdateAjax');

/*ajaxでbookの削除*/
Route::post('/ajaxbookremove','App\Http\Controllers\FormController@bookRemoveAjax');

/*ajaxでデータベースから情報を引っ張りたい時*/
Route::post('/ajaxgetdata','App\Http\Controllers\FormController@someGetter');


/*ユーザーページ*/
Route::get('users/{id}/books', 'App\Http\Controllers\UserPageController@getAbout')->name('user.books');