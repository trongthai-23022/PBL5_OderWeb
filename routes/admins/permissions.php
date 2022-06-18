<?php

//permissions

Route::prefix('permissions')->group(function (){
    Route::get('/', [
        'as' => 'permissions.index',
        'uses' => 'AdminPermissionController@index',
        'middleware' => 'can:permission-view'
    ]);
    Route::get('/create', [
        'as' => 'permissions.create',
        'uses' => 'AdminPermissionController@create',
        'middleware' => 'can:permission-add'
    ]);

    Route::post('/store', [
        'as' => 'permissions.store',
        'uses' => 'AdminPermissionController@store'
    ]);

    //button edit to show update form
    Route::get('/edit/{id}', [
        'as' => 'permissions.edit',
        'uses' => 'AdminPermissionController@edit',
        'middleware' => 'can:permission-edit'
    ]);
    // submit to update
    Route::post('/update/{id}', [
        'as' => 'permissions.update',
        'uses' => 'AdminPermissionController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'permissions.delete',
        'uses' => 'AdminPermissionController@delete',
        'middleware' => 'can:permission-delete'
    ]);
});
