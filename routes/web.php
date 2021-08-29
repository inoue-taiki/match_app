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

//ログイン・ログアウト・新規登録
Auth::routes();

//トップページ
Route::get('top', 'UserController@index')->name('top.index');

//プロフィール画面
Route::get('/users/profile', 'UserController@profile')->name('user.profile');
//プロフィール編集
Route::get('/users/profile_update', 'UserController@update')->name('user.profile_update');
