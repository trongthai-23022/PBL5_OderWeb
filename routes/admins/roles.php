<?php

//roles
Route::prefix('roles')->group(function (){
    Route::get('/', [
        'as' => 'roles.index',
        'uses' => 'AdminRoleController@index',
        'middleware'=> 'can:role-view'
    ]);
    Route::get('/create', [
        'as' => 'roles.create',
        'uses' => 'AdminRoleController@create',
        'middleware'=> 'can:role-add'
    ]);
    Route::post('/store', [
        'as' => 'roles.store',
        'uses' => 'AdminRoleController@store'
    ]);
    //button edit to show update form
    Route::get('/edit/{id}', [
        'as' => 'roles.edit',
        'uses' => 'AdminRoleController@edit',
        'middleware'=> 'can:role-edit'
    ]);
    // submit to update
    Route::post('/update/{id}', [
        'as' => 'roles.update',
        'uses' => 'AdminRoleController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'roles.delete',
        'uses' => 'AdminRoleController@delete',
        'middleware'=> 'can:role-delete'
    ]);
});
