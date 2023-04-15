<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RecoveryPasswordController extends Controller
{
	public function store(Request $request): RedirectResponse
	{
		$token = $request->input('token');
		$resetRecord = DB::table('password_reset_tokens')->where('token', $token)->first();

		if (!$resetRecord) {
			return redirect()->route('login')->with('error', 'Invalid password reset link.');
		}

		return redirect()->route('confirmation_email');
	}

	public function update(Request $request): RedirectResponse
	{
		// Validate the user's input
		$validator = Validator::make($request->all(), [
			'token'    => 'required',
			'email'    => 'required|email',
			'password' => 'required|confirmed|min:8',
		]);

		if ($validator->fails()) {
			return back()->withErrors($validator);
		}

		$token = $request->input('token');
		$email = $request->input('email');
		$password = $request->input('password');

		$resetRecord = DB::table('password_reset_tokens')->where('token', $token)->where('email', $email)->first();

		if (!$resetRecord) {
			return redirect()->route('login')->with('error', 'Invalid password reset link.');
		}

		// Update the user's password in the database
		DB::table('users')->where('email', $email)->update(['password' => Hash::make($password)]);

		// Delete the password reset record from the database
		DB::table('password_reset_tokens')->where('email', $email)->delete();

		// Redirect the user to a confirmation page
		return redirect()->route('confirmation_email');
	}
}
