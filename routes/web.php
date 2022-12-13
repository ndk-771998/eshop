<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WebController;

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

Route::get('/login', [AdminController::class, 'showLogin']);

Route::post('/login', [AdminController::class, 'postLoginAdmin']);

Route::get('/home', function(){
    return view('home');
});

Route::get('/', [WebController::class, 'homePage']);

Route::group(
    [
        'prefix' => 'categories',
        'namespace' => 'App\Http\Controllers',
        'middleware' => 'can:category-list'
    ],
    function () {
        Route::get('/', 'CategoryController@index')->name('categories.index');
        Route::get('/create', 'CategoryController@create')->name('categories.create');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('categories.edit');
        Route::get('/delete/{id}', 'CategoryController@delete')->name('categories.delete');
        Route::post('/update/{id}', 'CategoryController@update')->name('categories.update');
        Route::post('/store', 'CategoryController@store')->name('categories.store');
    }
);

Route::group(
    [
        'prefix' => 'menus',
        'namespace' => 'App\Http\Controllers',
        'middleware' => 'can:menu-list'
    ],
    function () {
        Route::get('/', 'MenuController@index')->name('menus.index');
        Route::get('/create', 'MenuController@create')->name('menus.create');
        Route::post('/store', 'MenuController@store')->name('menus.store');
        Route::get('/edit/{id}', 'MenuController@edit')->name('menus.edit');
        Route::get('/delete/{id}', 'MenuController@delete')->name('menus.delete');
        Route::post('/update/{id}', 'MenuController@update')->name('menus.update');
    }
);

Route::group(
    [
        'prefix' => 'products',
        'namespace' => 'App\Http\Controllers'
    ],
    function () {
        Route::get('/', 'AdminProductController@index')->name('products.index');
        Route::get('/create', 'AdminProductController@create')->name('products.create');
        Route::get('/edit/{id}', 'AdminProductController@edit')->name('products.edit');
        Route::get('/delete/{id}', 'AdminProductController@delete')->name('products.delete');
        Route::post('/store', 'AdminProductController@store')->name('products.store');
        Route::post('/update/{id}', 'AdminProductController@update')->name('products.update');
    }
);

// Slider

Route::group([
    'prefix' => 'sliders',
    'namespace' => 'App\Http\Controllers'
], function (){
    Route::get('/', 'SliderAdminController@index')->name('slider.index');
    Route::get('/create', 'SliderAdminController@create')->name('slider.create');
    Route::post('/store', 'SliderAdminController@store')->name('slider.store');
    Route::post('/update/{id}', 'SliderAdminController@update')->name('slider.update');
    Route::get('/edit/{id}', 'SliderAdminController@edit')->name('slider.edit');
    Route::get('/delete/{id}', 'SliderAdminController@delete')->name('slider.delete');
});

// Setting

Route::group([
    'prefix' => 'settings',
    'namespace' => 'App\Http\Controllers'
], function (){
    Route::get('/', 'SettingAdminController@index')->name('setting.index');
    Route::get('/create', 'SettingAdminController@create')->name('setting.create');
    Route::get('/delete/{id}', 'SettingAdminController@delete')->name('setting.delete');
    Route::get('/edit/{id}', 'SettingAdminController@edit')->name('setting.edit');
    Route::post('/update/{id}', 'SettingAdminController@update')->name('setting.update');
    Route::post('/store', 'SettingAdminController@store')->name('setting.store');
});

Route::group([
    'prefix' => 'posts',
    'namespace' => 'App\Http\Controllers'
], function (){
    Route::get('/', 'PostAdminController@index')->name('post.index');
    Route::get('/create', 'PostAdminController@create')->name('post.create');
    Route::get('/delete/{id}', 'PostAdminController@delete')->name('post.delete');
    Route::get('/edit/{id}', 'PostAdminController@edit')->name('post.edit');
    Route::post('/update/{id}', 'PostAdminController@update')->name('post.update');
    Route::post('/store', 'PostAdminController@store')->name('post.store');
});

Route::group([
    'prefix' => 'users',
    'namespace' => 'App\Http\Controllers'
], function (){
    Route::get('/', 'UserAdminController@index')->name('user.index');
    Route::get('/create', 'UserAdminController@create')->name('user.create');
    Route::get('/delete/{id}', 'UserAdminController@delete')->name('user.delete');
    Route::get('/edit/{id}', 'UserAdminController@edit')->name('user.edit');
    Route::post('/update/{id}', 'UserAdminController@update')->name('user.update');
    Route::post('/store', 'UserAdminController@store')->name('user.store');
});

Route::group([
    'prefix' => 'roles',
    'namespace' => 'App\Http\Controllers'
], function (){
    Route::get('/', 'RoleAdminController@index')->name('role.index');
    Route::get('/create', 'RoleAdminController@create')->name('role.create');
    Route::get('/delete/{id}', 'RoleAdminController@delete')->name('role.delete');
    Route::get('/edit/{id}', 'RoleAdminController@edit')->name('role.edit');
    Route::post('/update/{id}', 'RoleAdminController@update')->name('role.update');
    Route::post('/store', 'RoleAdminController@store')->name('role.store');
});

Route::get('contact-us', [ContactController::class, 'index']);
Route::post('contact-us', [ContactController::class, 'store'])->name('contact.us.store');
