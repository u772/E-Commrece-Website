<?php

namespace App\Http\Controllers\CozaStore\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function userLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->role == User::ROLE_USER) {
                return view('cozastore.store.index')->with('message', 'Welcome to The CozaStore ');
            }
        } else {
            return view('cozastore.store.auth.signin');
        }
    }

    public function userAuthenticate(Request $request)


    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        if (Auth::attempt($request->only('email', 'password'))) {
            if (!Auth::user()->role == User::ROLE_USER) {
                Auth::logout();
                return back()->with('error', 'Only user can access here.');
            }
            return redirect('home')->with('message', 'Welcome to The CozaStore ');
        }
        return back()->with('error', 'The given credentials are invalid');
    }



    //new code

    // public function userAuthenticate(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);
    
    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         if (Auth::user()->role == User::ROLE_USER) {
    //             return redirect('home');
    //         }
    //         return redirect('admin-home');
    //     }
    //     return back()->with('error', 'The given credentials are invalid');
    // }
    
}
