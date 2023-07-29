<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function adminlogout(){
        Auth::logout();
        Session::flush();
        return redirect('/admin/login');
    }

    public function userLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->back();
    }
}
