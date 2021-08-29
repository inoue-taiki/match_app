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

//トーク画面
Route::get('/users/talk', 'PostController@talk')->name('user.talk');
//トーク詳細(メッセージ投稿)
Route::get('/users/talk_detail', 'PostController@create')->name('talk.detail');

//ユーザー検索画面
Route::get('/users/search', 'UserController@search')->name('user.search');
Route::post('/users/search', 'UserController@search');

//相手ユーザー画面
Route::get('/users/other', 'UserController@other')->name('user.other');

//お気に入り画面
Route::get('/users/keep', 'KeepController@keep')->name('user.keep');

//マッチングユーザー画面
Route::get('/follows/match', 'FollowController@match')->name('follow.match');
//リクエスト中ユーザー画面
Route::get('/follows/follow', 'FollowController@follow')->name('follow.follow');
//リクエスト受けてるユーザー画面
Route::get('/follows/follower', 'FollowController@follower')->name('follow.follower');