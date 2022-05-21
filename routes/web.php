<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\MainController;

Route::get('/', function(){
    return view('SuperKay.main', [
        'title'=>'Super Kay'
    ]);
});
Route::get('/home', function () {
    return view('home');
});


Route::get('/admin-login', 'AdminController@loginAdmin');
Route::post('/admin-login', 'AdminController@postLoginAdmin');
Route::get('/logout', 'AdminController@logout')->name('admin.logout');
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

});


