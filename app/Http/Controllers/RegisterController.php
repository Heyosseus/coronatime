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
		$user = User::create($request->validated());
		$user->password = Hash::make($user->password);
		$user->save();

		return redirect()->route('login')->with('success', 'Your account has been created!');
	}
}
