<?php

use App\Http\Controllers\customers\CartController;
use App\Http\Controllers\customers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\customers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AminSliderController;

//Route::get('/', function(){
//    return view('Shop.main', [
//        'title'=>'Super Kay'
//    ]);
//});



Route::get('/home', [HomeController::class, 'index'])->name('app.home') ;
Route::get('/', [HomeController::class, 'index'])->name('app.home');

Route::get('/detail/{id}_{slug}',[ProductController::class,'detail'])->name('detail');
Route::post('/product-comment',[ProductController::class,'product_comment'])->middleware('auth', 'verified')->name('product.comment');
Route::get('/shop',[ProductController::class,'shop'])->name('shop');
Route::get('/shop/{id}-{slug}',[ProductController::class,'category_products'])->name('category');


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('auth', 'verified')->name('admin.dashboard');

    Route::get('/login', [AdminController::class, 'loginAdmin']);
    Route::post('/login', [AdminController::class, 'postLoginAdmin']);
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    //menus
//    Route::prefix('menus')->group(function () {
//        Route::get('/', [
//            'as' => 'menus.index',
//            'uses' => 'MenuController@index'
//        ]);
//        Route::get('/create', [
//            'as' => 'menus.create',
//            'uses' => 'MenuController@create'
//        ]);
//        Route::post('/store', [
//            'as' => 'menus.store',
//            'uses' => 'MenuController@store'
//        ]);
//        //button edit to show update form
//        Route::get('/edit/{id}', [
//            'as' => 'menus.edit',
//            'uses' => 'MenuController@edit'
//        ]);
//        // submit to update
//        Route::post('/update/{id}', [
//            'as' => 'menus.update',
//            'uses' => 'MenuController@update'
//        ]);
//        Route::get('/delete/{id}', [
//            'as' => 'menus.delete',
//            'uses' => 'MenuController@delete'
//        ]);
//    });

    //slider
    Route::prefix('sliders')->group(function () {
        Route::get('/', [AminSliderController::class, 'index'])->can('slider-view')->name('sliders.index');
        Route::get('/create', [AminSliderController::class, 'create'])->can('slider-add')->name('sliders.create');
        Route::post('/store', [AminSliderController::class, 'store'])->name('sliders.store');
        Route::post('/edit/{id}', [AminSliderController::class, 'edit'])->can('slider-edit')->name('sliders.edit');
        Route::post('/update/{id}', [AminSliderController::class, 'update'])->name('sliders.update');
        Route::get('/delete/{id}', [AminSliderController::class, 'delete'])->can('slider-delete')->name('sliders.delete');

        Route::prefix('banners')->group(function (){
            Route::get('/', [AminSliderController::class, 'index_banner'])->can('slider-view')->name('banners.index');
            Route::get('/create', [AminSliderController::class, 'create_banner'])->can('slider-add')->name('banners.create');
        });
    });

    // order
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->can('order-view')->name('orders.index');
        Route::get('/api', [OrderController::class, 'api'])->name('api.orders.index');
        Route::get('/edit/{id}', [OrderController::class, 'edit'])->can('order-edit')->name('orders.edit');
        Route::post('/update', [OrderController::class, 'update_status'])->name('orders.update');

        Route::get('/detail/{id}', [OrderController::class, 'detail_show'])->name('orders.detail.show');
        Route::get('/buy-again/{id}', [OrderController::class, 'buy_again'])->name('orders.buyagain');


    });

});

Route::prefix('cart')->middleware('auth')->group(function (){
    Route::get('/',[CartController::class,'index'])->name('cart.index');
    Route::post('/store',[CartController::class,'store'])->name('cart.store');
    Route::get('/update',[CartController::class,'update'])->name('cart.update');
    Route::get('/destroy/{rowId}',[CartController::class,'destroy'])->name('cart.destroy');
    Route::get('/remove-all',[CartController::class,'remove_all'])->name('cart.removeall');

    Route::get('/checkout-info', [CartController::class,'getCheckout'])
        ->middleware('verified')
        ->name('cart.checkout.info');

    Route::post('/order', [CartController::class,'postOrder'])
        ->middleware('verified')
        ->name('cart.order');

});

Route::prefix('account')->middleware(['auth','verified'])->group(function (){
    Route::get('/purchases',[OrderController::class, 'user_purchase_show'])->name('purchase.show');
    Route::get('/profile',[UserController::class,'show'])->name('account.show');
    Route::post('/profile',[UserController::class,'store'])->name('account.store');
});



require_once __DIR__ . '/fortify.php';


