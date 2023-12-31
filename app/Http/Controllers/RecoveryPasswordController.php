<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecoveryPasswordRequest;
use App\Mail\RecoveryPasswordMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RecoveryPasswordController extends Controller
{
	public function create($token)
	{
		$user = User::where(['token' => $token, 'is_verified' => 0])->first();
		if ($user) {
			$email = $user->email;
			return view('verification.new-password', compact('email', 'token'));
		}
		return redirect()->route('reset_password')->with('failed', 'Password reset link is expired');
	}

	public function update(StoreRecoveryPasswordRequest $request): RedirectResponse
	{
		$user = User::where('email', $request->email)->first();


		if ($user) {
            Mail::to($user->email)->send(new RecoveryPasswordMail($user->token));
			$user->password = Hash::make($request->password);
			$user->save();
			return redirect()->route('confirmation_email')->with('success', 'Success! password has been changed');
		}
        return redirect()->route('reset_password')->with('failed', 'Password reset link is expired');

    }
}
