<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Check if the "remember_device" checkbox was checked
        $rememberDevice = $request->has('remember_device') ? true : false;

        // Store the value of the checkbox in the "users" table
        $user->remember_device = $rememberDevice;
        $user->save();

        return redirect('/')->with('success', 'Your account has been created!');
    }
}
