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

Route::get('/', function () {
    return view('welcome');
});
//shopscate route
Route::resource('shopcates','ShopCategoriesController');
//shops route
Route::resource('shopmanagers','ShopManagerController');

//后台商家信息审核
Route::get('shops/verify','ShopManagerController@verify')->name('shops.verify');
Route::post('shops/verifystore','ShopManagerController@verifyStore')->name('shops.verifystore');

//后台添加商家信息及用户信息
Route::get('register','ShopManagerController@register')->name('register');
Route::post('register/store','ShopManagerController@registerStore')->name('register.store');

//admin route
Route::resource('admins','AdminController');
//user route
Route::resource('users','UserController');
//users 审核
Route::get('verify','UserController@verify')->name('verify');
Route::post('verify/store','UserController@verifyStore')->name('verify.store');
//重置商家密码
Route::get('reset','UserController@reset')->name('reset');
//session route
Route::get('session/login','SessionController@login')->name('session.login');
Route::post('session/verify','SessionController@verify')->name('session.verify');
Route::get('session/logout','SessionController@logout')->name('session.logout');
Route::get('session/edit','SessionController@edit')->name('session.edit');
Route::post('session/store','SessionController@store')->name('session.store');