<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
	public function create(): View
	{
		return view('auth.login');
	}

	public function store(StoreLoginRequest $request): RedirectResponse
	{
		$attributes = $request->validated();

		if (auth()->attempt($attributes)) {
			$request->session()->regenerate();

			session()->flash('status', 'Welcome Back!');
			return redirect()->route('home');
		}

		return back()->withErrors(['name' => 'Your provided credentials could not be verified.']);
	}

	public function destroy(): RedirectResponse
	{
		auth()->logout();

		return redirect()->route('home')->with('success', 'Goodbye!');
	}
}
