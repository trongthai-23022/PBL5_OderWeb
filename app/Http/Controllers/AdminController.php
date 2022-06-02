<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth\Fatory;

class AdminController extends Controller
{
    //
    public function loginAdmin()
    {

//        dd(bcrypt('admin'));
        if(auth()->check()){
            return redirect()->to('admin/dashboard');
        }
        return view('admin.admin-login');
    }

    public function postLoginAdmin(Request $request)
    {
        $remember = $request->has('remember')? true: false;
        if (Auth::attempt(['email' => $request->email,
            'password' => $request->password
        ], $remember)){
//            $request->session()->regenerate();
            return redirect()->to('admin/dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }
}
