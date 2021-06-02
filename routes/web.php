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


/*ajaxで新規showcaseの登録*/
Route::any('/ajax_showcase_add','App\Http\Controllers\FormController@showcaseAddAjax');

/*ajaxで新規showcaseの情報取得*/
Route::any('/ajax_get_showcase','App\Http\Controllers\FormController@ShowcasesGetter');

/*ajaxでshowcaseの削除*/
Route::post('/ajax_remove_showcase','App\Http\Controllers\FormController@ShowcasesRemoveAjax');



/*ajaxでShoecase itemのデータ取得*/
Route::any('/ajax_getData_by_id','App\Http\Controllers\FormController@getShowcaseItemAjax');

/*ajaxでShoecase itemの登録*/
Route::any('/apply_new_item','App\Http\Controllers\FormController@AddNewItemAjax');

/*ajaxでcellの更新*/
Route::any('/ajax_edit_showcase_item','App\Http\Controllers\FormController@editShowcaseItemAjax');

/*ajaxでShoecase itemの削除*/
Route::post('/ajax_remove_showcase_item','App\Http\Controllers\FormController@removeShowcaseItemAjax');


/*ajaxでデータベースから情報を引っ張りたい時(showcase一覧)*/
Route::post('/ajaxgetdata','App\Http\Controllers\FormController@someGetter');
/*ajaxでデータベースから情報を引っ張りたい時(特定のshowcase内のmemory)*/
Route::post('/get_memory','App\Http\Controllers\FormController@getMemory');





/*ショーケースページ*/
Route::get('users/{id}/{title}', 'App\Http\Controllers\UserPageController@getShowcaseDetail')->name('user.showcase_detail');