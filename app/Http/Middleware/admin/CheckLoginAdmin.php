<?php

namespace App\Http\Middleware\admin;

use App\Http\Middleware\Authenticate;
use Closure;
use Doctrine\DBAL\Driver\Middleware;
use Illuminate\Http\Request;

class CheckLoginAdmin extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('admin-login');
        }
    }
}
