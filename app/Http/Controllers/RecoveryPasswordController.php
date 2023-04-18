<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RecoveryPasswordController extends Controller
{
	public function create($token)
	{
		$user = User::where('token', $token)->where('is_verified', 0)->first();
		if ($user) {
			$email = $user->email;
			return view('verification.new-password', compact('email', 'token'));
		}
		return redirect()->route('verification.reset-password')->with('failed', 'Password reset link is expired');
	}

	public function update(Request $request): RedirectResponse
	{
		//		dd($request->all());
		$this->validate($request, [
			'email'                 => 'required',
			'password'              => 'required|min:6',
			'password_confirmation' => 'required|same:password',
		]);

		$user = User::where('email', $request->email)->first();
		if ($user) {
			$user->password = Hash::make($request->password);
			$user->save();
			return redirect()->route('confirmation_email')->with('success', 'Success! password has been changed');
		}
		return redirect()->route('reset_password')->with('failed', 'Failed! something went wrong');
	}
}
