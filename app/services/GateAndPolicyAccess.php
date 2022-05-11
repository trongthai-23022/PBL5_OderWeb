<?php

namespace App\services;

use Illuminate\Support\Facades\Gate;

class GateAndPolicyAccess
{
    public static function setGateAndPolicyAccess()
    {
        GateAndPolicyAccess::defineGateCategory();
    }

    private static function defineGateCategory(){
        Gate::define('category-view', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
    }
}
