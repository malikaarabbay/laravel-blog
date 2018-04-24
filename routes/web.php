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

// frontend

Route::group(['namespace' => 'User'], function(){
    Route::get('/', 'HomeController@index');
    Route::get('post/', 'PostController@index')->name('post');
    Route::get('post/{model?}', 'PostController@view')->name('post');
    Route::get('post/tag/{model?}', 'HomeController@tag')->name('tag');
    Route::get('post/category/{model?}', 'HomeController@category')->name('category');
    Route::get('profile/', 'ProfileController@index')->name('profile');
    Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('profile/update/{user}', 'ProfileController@update')->name('profile.update');
    Route::get('home/get-region-list','HomeController@getRegionList');
    Route::get('home/get-city-list','HomeController@getCityList');
    Route::put('profile/change-password/{user}', 'ProfileController@changePassword')->name('profile.change-password');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
    Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

    Route::get('item/index', 'ItemController@index');
    Route::post('item/create', 'ItemController@create')->name('item.create');
});

// localization
Route::get('lang/{lang}', function($lang) {
    \Session::put('lang', $lang);
    return \Redirect::back();
})->middleware('web')->name('change_lang');

// backend

Route::group(['namespace' => 'Admin'], function() {
    Route::get('admin/index', 'HomeController@index')->name('admin.index');
    Route::resource('admin/post', 'PostController');
    Route::resource('admin/category', 'CategoryController');
    Route::resource('admin/tag', 'TagController');
    Route::resource('admin/role', 'RoleController');
    Route::resource('admin/permission', 'PermissionController');
    Route::resource('admin/user', 'UserController');
    Route::post('admin/post/search', 'PostController@search')->name('post.search');

    Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'Auth\LoginController@login');
});

Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');