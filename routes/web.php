<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\customers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AminSliderController;

//Route::get('/', function(){
//    return view('SuperKay.main', [
//        'title'=>'Super Kay'
//    ]);
//});



Route::get('/home', [HomeController::class, 'index'])->name('app.home')->middleware('auth', 'verified');
Route::get('/', [HomeController::class, 'index'])->name('app.home')->middleware('auth', 'verified');

Route::get('/detail/{id}.html',[\App\Http\Controllers\User\ProductController::class,'index'])->name('detail');
Route::get('/shop',[\App\Http\Controllers\User\ProductController::class,'shop'])->name('shop');
Route::get('/shop/{id}-{slug}.html',[\App\Http\Controllers\User\ProductController::class,'category_products'])->name('category');


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('auth', 'verified')->name('admin.dashboard');

    Route::get('/login', [AdminController::class, 'loginAdmin']);
    Route::post('/login', [AdminController::class, 'postLoginAdmin']);
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

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

    //slider
    Route::prefix('sliders')->group(function () {
        Route::get('/', [AminSliderController::class, 'index'])->name('sliders.index');
        Route::get('/create', [AminSliderController::class, 'create'])->name('sliders.create');
        Route::post('/store', [AminSliderController::class, 'store'])->name('sliders.store');
        //button edit to show update form
        Route::get('/edit/{id}', [
            'as' => 'sliders.edit',
            'uses' => 'AminSliderController@edit'
        ]);
        // submit to update
        Route::post('/update/{id}', [
            'as' => 'sliders.update',
            'uses' => 'AminSliderController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'sliders.delete',
            'uses' => 'AminSliderController@delete'
        ]);
    });
});

require_once __DIR__ . '/fortify.php';


