<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginContoller extends Controller
{
    public function adminLogin_view()
    {
        if (Auth::check() && Auth::user()->role == User::ROLE_ADMIN) {
            return view('admin.pages.index');
        } else {
            return view('admin.pages.auth.login');
        }
    }

    //new code

    
    public function adminAuthenticate(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'

        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (!(Auth::user()->role == User::ROLE_ADMIN)) {
                Auth::logout();
                return redirect()->back()->withErrors(['errors' => 'Only admin can access here.']);
            }
            return redirect()->route('dashboard')->with('message', 'Welcome to The Admin Panel');
        }

        return redirect()->back()->withErrors(['errors' => 'The given credentials are invalid']);
    }
}
