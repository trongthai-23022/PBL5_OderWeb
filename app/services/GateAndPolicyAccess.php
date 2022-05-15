<?php

namespace App\services;

use Illuminate\Support\Facades\Gate;

class GateAndPolicyAccess
{
    public static function setGateAndPolicyAccess()
    {
        GateAndPolicyAccess::defineGateCategory();
        GateAndPolicyAccess::defineGateProduct();
    }

    private static function defineGateCategory(){
        Gate::define('category-view', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
    }
    private static function defineGateProduct(){
        Gate::define('product-view', 'App\Policies\ProductPolicy@view');
        Gate::define('product-add', 'App\Policies\ProductPolicy@create');
        Gate::define('product-edit', 'App\Policies\ProductPolicy@update');
        Gate::define('product-delete', 'App\Policies\ProductPolicy@delete');
    }
}
