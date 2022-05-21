<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function index(){
        echo 123;
        return view('SuperKay.main', [
            'title'=>'Super Kay'
        ]);
    }
}
