<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes =  $request->validate([
             'name' => 'required|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
             'password_confirmation' => 'required',
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
        ]);

        // Check if the "remember_device" checkbox was checked
        $rememberDevice = $request->has('remember_device');

        // Store the value of the checkbox in the "users" table
        $user->remember_device = $rememberDevice;
        $user->save();

        return redirect('/')->with('success', 'Your account has been created!');
    }
}
