<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|min:5',
            'password' => 'required|min:5'
        ]);

        // dd($validated);

        if(Auth::attempt($validated)){
            $request->session()->regenerate();

            return redirect('/')->with('success', 'You are now logged in!');
        }

        return back()->withErrors([
            'password' => 'We could not authenticate with the credentials provided'
        ])->withInput();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
