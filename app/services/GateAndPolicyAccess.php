<?php

namespace App\services;

use Illuminate\Support\Facades\Gate;

class GateAndPolicyAccess
{
    public static function setGateAndPolicyAccess()
    {
        GateAndPolicyAccess::defineGateCategory();
        GateAndPolicyAccess::defineGateProduct();
        GateAndPolicyAccess::defineGateSlider();
        GateAndPolicyAccess::defineGateOrder();
        GateAndPolicyAccess::defineGateUser();
        GateAndPolicyAccess::defineGateRole();
        GateAndPolicyAccess::defineGatePermission();

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
    private static function defineGateSlider(){
        Gate::define('slider-view', 'App\Policies\SliderPolicy@view');
        Gate::define('slider-add', 'App\Policies\SliderPolicy@create');
        Gate::define('slider-edit', 'App\Policies\SliderPolicy@update');
        Gate::define('slider-delete', 'App\Policies\SliderPolicy@delete');
    }
    private static function defineGateOrder(){
        Gate::define('order-view', 'App\Policies\OrderPolicy@view');
        Gate::define('order-add', 'App\Policies\OrderPolicy@create');
        Gate::define('order-edit', 'App\Policies\OrderPolicy@update');
        Gate::define('order-delete', 'App\Policies\OrderPolicy@delete');
    }
    private static function defineGateUser(){
        Gate::define('user-view', 'App\Policies\UserPolicy@view');
        Gate::define('user-add', 'App\Policies\UserPolicy@create');
        Gate::define('user-edit', 'App\Policies\UserPolicy@update');
        Gate::define('user-delete', 'App\Policies\UserPolicy@delete');
    }

    private static function defineGateRole(){
        Gate::define('role-view', 'App\Policies\RolePolicy@view');
        Gate::define('role-add', 'App\Policies\RolePolicy@create');
        Gate::define('role-edit', 'App\Policies\RolePolicy@update');
        Gate::define('role-delete', 'App\Policies\RolePolicy@delete');
    }
    private static function defineGatePermission(){
        Gate::define('permission-view', 'App\Policies\PermissionPolicy@view');
        Gate::define('permission-add', 'App\Policies\PermissionPolicy@create');
        Gate::define('permission-edit', 'App\Policies\PermissionPolicy@update');
        Gate::define('permission-delete', 'App\Policies\PermissionPolicy@delete');
    }
}
