<?php
use Illuminate\Support\Facades\Route;
//products
Route::prefix('products')->group(function () {
    Route::get('/', [
        'as' => 'products.index',
        'uses' => 'AdminProductController@index',
        'middleware' => 'can:product-view'
    ]);
    Route::get('api/products/index', [\App\Http\Controllers\AdminProductController::class, 'api'])->name('api.products.index');
    Route::get('/create', [
        'as' => 'products.create',
        'uses' => 'AdminProductController@create',
        'middleware' => 'can:product-add'
    ]);
    Route::post('/store', [
        'as' => 'products.store',
        'uses' => 'AdminProductController@store'
    ]);
    //button edit to show update form
    Route::get('/edit/{id}', [
        'as' => 'products.edit',
        'uses' => 'AdminProductController@edit',
        'middleware' => 'can:product-edit'
    ]);
    // submit to update
    Route::post('/update/{id}', [
        'as' => 'products.update',
        'uses' => 'AdminProductController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'products.delete',
        'uses' => 'AdminProductController@delete',
        'middleware' => 'can:product-delete'

    ]);
});
