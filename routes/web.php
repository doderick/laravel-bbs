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

Route::get('/', 'TopicsController@index')->name('root');

// Auth::routes(); 以下为等价路由替换
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
// Auth::routes() 等价路由完

// 用户资源相关路由
Route::resource('users', 'UsersController', ['only' => ['show', 'edit', 'update']]);

// 话题相关路由
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

// 分类相关路由
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

// 图片上传相关路由
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

// 回复相关路由
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

// 通知相关路由
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

// 后台权限验证失败后的路由
Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');

// 显示关注的人及粉丝列表视图的相关路由
Route::get('users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('users/{user}/followers', 'UsersController@followers')->name('users.followers');

// 关注与取消关注相关路由
Route::post('users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');