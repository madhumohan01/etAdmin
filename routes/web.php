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
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Route::resource('sections', 'SectionController');

Route::resource('places', 'PlaceController');

Route::resource('aEmails', 'AEmailController');

Route::resource('aPosts', 'APostsController');

Route::resource('keywords', 'KeywordController');

Route::resource('unsubscribeLists', 'UnsubscribeListController');