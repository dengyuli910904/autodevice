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
// 文件上传
Route::group(['prefix' => 'common'],function(){
    Route::get('/upload','UeditorController@server');
    Route::post('/upload','UeditorController@server');
    Route::any('/fileupload','UeditorController@uploadimg');
});

// 品牌路由
Route::group(['prefix'=>'brand'],function(){
    route::get('list','BrandController@index');
    route::get('edit','BrandController@edit');
    route::get('create','BrandController@create');
    route::post('store','BrandController@store');
    route::put('update','BrandController@update');
    route::delete('delete','BrandController@destory');
    route::put('handle','BrandController@handle');
});
// 产品路由
Route::group(['prefix'=>'product'],function(){
    route::get('list','ProductController@index');
    route::get('edit','ProductController@edit');
    route::get('create','ProductController@create');
    route::post('store','ProductController@store');
    route::put('update','ProductController@update');
    route::delete('delete','ProductController@destory');
    route::put('handle','ProductController@handle');
});

// 类型路由
Route::group(['prefix'=>'type'],function(){
    route::get('list','TypeController@index');
    route::get('edit','TypeController@edit');
    route::get('create','TypeController@create');
    route::post('store','TypeController@store');
    route::put('update','TypeController@update');
    route::delete('delete','TypeController@destory');
});
// 新闻路由
Route::group(['prefix'=>'news'],function(){
    route::get('list','NewsController@index');
    route::get('edit','NewsController@edit');
    route::get('create','NewsController@create');
    route::post('store','NewsController@store');
    route::put('update','NewsController@update');
    route::delete('delete','NewsController@destory');
});
// 招聘路由
Route::group(['prefix'=>'jobs'],function(){
    route::get('list','JobsController@index');
    route::get('edit','JobsController@edit');
    route::get('create','JobsController@create');
    route::post('store','JobsController@store');
    route::put('update','JobsController@update');
    route::delete('delete','JobsController@destory');
});
// 首页管理路由
Route::group(['prefix'=>'homepage'],function(){
    route::get('list','HomepageController@index');
    route::get('edit','HomepageController@edit');
    route::get('create','HomepageController@create');
    route::post('store','HomepageController@store');
    route::put('update','HomepageController@update');
    route::delete('delete','HomepageController@destory');
});
