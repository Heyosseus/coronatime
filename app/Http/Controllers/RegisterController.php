<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
	public function create()
	{
		return view('auth.register');
	}

	public function store(StoreRegisterRequest $request): RedirectResponse
	{
		$attributes = $request->validated();

		$user = User::create([
			'name'     => $attributes['name'],
			'email'    => $attributes['email'],
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
