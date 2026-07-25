<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(){
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request){
        // dd($request->all());

        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|max:255|min:3',
            'password' => 'nullable|max:255|min:8'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? $request->password : $user->password
        ]);

        return redirect()->route('idea.index')->with('success', 'Profile updated successfully!');
    }
}
