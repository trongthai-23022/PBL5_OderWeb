<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::get('/admin', 'AdminController@loginAdmin');
Route::post('/admin', 'AdminController@postLoginAdmin');

Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->group(function () {

    //menus
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'MenuController@index'
        ]);
        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'MenuController@create'
        ]);
        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'MenuController@store'
        ]);
        //button edit to show update form
        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit'
        ]);
        // submit to update
        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'MenuController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete'
        ]);
    });

    //products
    Route::prefix('products')->group(function () {
        Route::get('/', [
            'as' => 'products.index',
            'uses' => 'AdminProductController@index'
        ]);
        Route::get('/create', [
            'as' => 'products.create',
            'uses' => 'AdminProductController@create'
        ]);
        Route::post('/store', [
            'as' => 'products.store',
            'uses' => 'AdminProductController@store'
        ]);
        //button edit to show update form
        Route::get('/edit/{id}', [
            'as' => 'products.edit',
            'uses' => 'AdminProductController@edit'
        ]);
        // submit to update
        Route::post('/update/{id}', [
            'as' => 'products.update',
            'uses' => 'AdminProductController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'products.delete',
            'uses' => 'AdminProductController@delete'
        ]);
    });

    //users
    Route::prefix('users')->group(function (){
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'AdminUserController@index'
        ]);
        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'AdminUserController@create'
        ]);
        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'AdminUserController@store'
        ]);
        //button edit to show update form
        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'AdminUserController@edit'
        ]);
        // submit to update
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'AdminUserController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'AdminUserController@delete'
        ]);
    });

    //roles
    Route::prefix('roles')->group(function (){
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'AdminRoleController@index'
        ]);
        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'AdminRoleController@create'
        ]);
        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'AdminRoleController@store'
        ]);
        //button edit to show update form
        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'AdminRoleController@edit'
        ]);
        // submit to update
        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'AdminRoleController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'roles.delete',
            'uses' => 'AdminRoleController@delete'
        ]);
    });

    Route::prefix('permissions')->group(function (){
        Route::get('/', [
            'as' => 'permissions.index',
            'uses' => 'AdminPermissionController@index'
        ]);
        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'AdminPermissionController@create'
        ]);
        Route::get('/create-manual', [
            'as' => 'permissions.create-manual',
            'uses' => 'AdminPermissionController@create_manual'
        ]);
        Route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'AdminPermissionController@store'
        ]);
        Route::post('/store-manual', [
            'as' => 'permissions.store-manual',
            'uses' => 'AdminPermissionController@store_manual'
        ]);
        //button edit to show update form
        Route::get('/edit/{id}', [
            'as' => 'permissions.edit',
            'uses' => 'AdminPermissionController@edit'
        ]);
        // submit to update
        Route::post('/update/{id}', [
            'as' => 'permissions.update',
            'uses' => 'AdminPermissionController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'permissions.delete',
            'uses' => 'AdminPermissionController@delete'
        ]);
    });
});


