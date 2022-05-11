<?php
//categories
Route::prefix('categories')->group(function () {
    Route::get('/', [
        'as' => 'categories.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:category-view'
    ]);
    //show create a new category form
    Route::get('/create', [
        'as' => 'categories.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:category-add'
    ]);
    // add category to db
    Route::post('/store', [
        'as' => 'categories.store',
        'uses' => 'CategoryController@store',
    ]);
    //button edit to show update form
    Route::get('/edit/{id}', [
        'as' => 'categories.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:category-edit'
    ]);
    // submit to update
    Route::post('/update/{id}', [
        'as' => 'categories.update',
        'uses' => 'CategoryController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'categories.delete',
        'uses' => 'CategoryController@delete',
        'middleware' => 'can:category-delete'
    ]);

});
