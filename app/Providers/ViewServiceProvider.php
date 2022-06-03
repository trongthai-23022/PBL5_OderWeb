<?php

namespace App\Providers;

use App\Http\View\Composers\CatagoryComposer;
use App\Http\View\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;



class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('SuperKay.partials.header', MenuComposer::class);
        View::composer('SuperKay.products.shop', CatagoryComposer::class);
    }
}
