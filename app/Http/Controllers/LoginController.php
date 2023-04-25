<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
	public function create()
	{
		return view('auth.login');
	}

	public function store(StoreLoginRequest $request): RedirectResponse
	{
		$attributes = $request->validated();

		if (!auth()->attempt($attributes)) {
			throw ValidationException::withMessages([
				'name'     => 'Your provided credentials could not be verified.',
				'password' => 'Your provided credentials could not be verified.',
			]);
		}
		session()->regenerate();

		session()->flash('status', 'Welcome Back!');

		return redirect()->route('home');
	}

	public function destroy(): RedirectResponse
	{
		auth()->logout();

		return redirect()->route('home')->with('success', 'Goodbye!');
	}
}
