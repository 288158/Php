<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|这里是您可以为您的应用程序******注册web路由******的地方。这些
|路由由RouteServiceProvider在其中一个组中加载
|包含“web”中间件组。现在创造一些伟大的东西!
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('/login','MyController@login');
Route::any('/loginCheck','MyController@loginCheck');
Route::any('/loginSuccess','MyController@loginSuccess');

Route::any('/register','MyController@register');
Route::any('/add','MyController@add');

Route::any('/insert','MyController@insert');
Route::any('/out','MyController@out');
Route::any('/insert_home','MyController@insert_home');
Route::any('/update_home','MyController@update_home');
Route::any('/update_home_op','MyController@update_home_op');
Route::any('/delete_home','MyController@delete_home');
Route::any('/accept_home','MyController@accept_home');
Route::any('/un_accept_home','MyController@un_accept_home');

Route::any('/todo','MyController@todo');
Route::any('/todo_all','MyController@todo_all');

Route::any('/add_list','MyController@add_list');
Route::any('/add_list_op','MyController@add_list_op');
Route::any('/list_all','MyController@list_all');
Route::any('/list_do','MyController@list_do');
Route::any('/list_end','MyController@list_end');
Route::any('/del_list_end','MyController@del_list_end');

Route::any('/update_list','MyController@update_list');
Route::any('/update_list_op','MyController@update_list_op');
Route::any('/delSelect','MyController@delSelect');

Route::any('/add_friend','MyController@add_friend');
Route::any('/delete_friend','MyController@delete_friend');
