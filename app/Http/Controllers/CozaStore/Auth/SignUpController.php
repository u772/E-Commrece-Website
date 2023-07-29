<?php

namespace App\Http\Controllers\CozaStore\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function view(){
        return view('cozastore.store.auth.signup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required',
            'phone_number' => 'required|numeric',
            'address' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads/user'), $imageName);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'image' => $imageName,
            'role'=>'user'
        ]);

        // dd($user);
    
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('home')->with('message', 'Welcome to The CozaStore ');
        }
    
        return redirect('register')->withError('Error');
    }
    
    
}
