<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request->all());

        // Validate the inputs
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'email' => 'required',
            'password' => 'required|min:5|max:255'
        ]);

        // Push the user to the users table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Login the New registered User
        Auth::login($user);

        // Redirect Back to the Home Page
        return redirect('/');
    }
}
