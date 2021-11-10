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
Route::get('/users/{id}/profile_update', 'UserController@update')->name('user.profile_update');
Route::post('/users/{id}/profile_update', 'UserController@update')->name('user.profile_update');
Route::get('/file_upload','UserController@update')->name('user.profile_update');
Route::post('/file_upload','UserController@update')->name('user.profile_update');

//投稿一覧画面
Route::post('/users/post', 'PostController@create')->name('user.post');
Route::get('/users/post', 'PostController@index')->name('user.post');

//ユーザー検索画面
Route::get('/users/search', 'UserController@search')->name('user.search');
Route::post('/users/search', 'UserController@search');
//フォローする
Route::post('/users/{id}/request', 'UserController@request')->name('user.request');
Route::get('/users/{id}/request', 'UserController@request')->name('user.request');

//相手ユーザー画面
Route::get('/users/other', 'UserController@other')->name('user.other');
//相手とのトーク
Route::post('/users/{id}/talk','UserController@talk')->name('user.talk');
Route::get('/users/{id}/talk','UserController@talk')->name('user.talk');

Route::get('/users/talk', 'PostController@talkcreate')->name('talk.post');
Route::post('/users/talk', 'PostController@talkcreate')->name('talk.post');


//お気に入りに追加
Route::post('/users/{id}/add', 'KeepController@add')->name('keep.add');
Route::get('/users/{id}/add', 'KeepController@add')->name('keep.add');
Route::post('/users/{id}/delete', 'KeepController@delete')->name('keep.delete');

//お気に入り画面
Route::get('/users/keep', 'KeepController@keep')->name('user.keep');

//マッチングユーザー画面
Route::get('/follows/match', 'FollowController@match')->name('follow.match');
Route::post('/follows/{id}/unfollow', 'FollowController@unfollow')->name('user.unfollow');

//リクエスト中ユーザー画面
Route::get('/follows/follow', 'FollowController@follow')->name('follow.follow');
Route::post('/follows/{id}/unrequest', 'FollowController@unrequest')->name('user.unrequest');

//リクエスト受けてるユーザー画面
Route::get('/follows/follower', 'FollowController@follower')->name('follow.follower');
//リクエスト許可
Route::post('/follows/{id}/match', 'FollowController@accept')->name('user.add');
//リクエスト拒否
Route::post('/follows/{id}/follower', 'FollowController@decline')->name('user.decline');

//フォローする
Route::post('/follows/{id}/follow', 'FollowController@follow')->name('user.follow');

//スケジュール
Route::get('/users/schedule', 'ScheduleController@schedule')->name('user.schedule');
Route::post('/users/schedule', 'ScheduleController@schedule_add')->name('user.schedule');
Route::post('/users/schedule', 'ScheduleController@schedule_edit')->name('user.schedule');


//練習用
Route::get('/follows/practice', 'FollowController@practice')->name('follow.practice');
Route::post('/follows/practice', 'FollowController@practice')->name('follow.practice');

//フォローする
Route::post('/follows/{id}/practice', 'FollowController@add')->name('follow.add');
