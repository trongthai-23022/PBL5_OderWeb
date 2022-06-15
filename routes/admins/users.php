<?php

use App\Http\Controllers\customers\UserController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
//users
Route::prefix('users')->group(function (){
    Route::get('/', [
        'as' => 'users.index',
        'uses' => 'AdminUserController@index',
        'middleware'=> 'can:user-view'
    ]);
    Route::get('/create', [
        'as' => 'users.create',
        'uses' => 'AdminUserController@create',
        'middleware'=> 'can:user-add'
    ]);
    Route::post('/store', [
        'as' => 'users.store',
        'uses' => 'AdminUserController@store'
    ]);
    //button edit to show update form
    Route::get('/edit/{id}', [
        'as' => 'users.edit',
        'uses' => 'AdminUserController@edit',
        'middleware'=> 'can:user-edit'
    ]);
    // submit to update
    Route::post('/update/{id}', [
        'as' => 'users.update',
        'uses' => 'AdminUserController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'users.delete',
        'uses' => 'AdminUserController@delete',
        'middleware'=> 'can:user-delete'
    ]);

});
