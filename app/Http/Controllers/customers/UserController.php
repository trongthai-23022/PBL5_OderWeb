<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function show()
    {
        return view('profile.user-profile');
    }
}
