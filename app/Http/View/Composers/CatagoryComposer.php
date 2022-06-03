<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\View\View;

class CatagoryComposer
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
        $categories =  Category::select('id','name','parent_id')->orderByDesc('id')->get();
        $view->with('categories', $categories);
    }
}
