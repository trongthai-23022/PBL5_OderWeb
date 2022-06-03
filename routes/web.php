<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\customers\MainController;
use App\Http\Controllers\AdminController;

//Route::get('/', function(){
//    return view('SuperKay.main', [
//        'title'=>'Super Kay'
//    ]);
//});

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/product/detail/{id}',[\App\Http\Controllers\User\ProductController::class,'index'])->name('detail');


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('auth', 'verified')->name('admin.dashboard');

    Route::get('/login', [AdminController::class,'loginAdmin']);
    Route::post('/login', [AdminController::class,'postLoginAdmin']);
    Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');

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


