<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@index');

//用户注册路由
Route::get('/auth/register', 'Auth\AuthController@getRegister');
Route::post('/auth/register', 'Auth\AuthController@postRegister');
Route::get('/home', 'IndexController@index');

//用户登录
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');

//用户登出路由
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

//用户借款功能
Route::get('/borrow', 'ProjectController@getBorrow');
Route::post('/borrow', 'ProjectController@postBorrow');

//管理员审核
Route::get('/prolist', 'CheckController@checkList'); //审核列表
Route::get('/check/{pid}', 'CheckController@check'); //管理员审核
Route::post('/checked', 'CheckController@checked');
