<?php

namespace App\Http\View\Composers;
use Illuminate\View\View;
use App\Models\Menu;

class MenuComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {

    }


    public function compose(View $view)
    {

    }
}
