<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class VerifyEmailController extends Controller
{
	public function create(): View
	{
		return view('verification.reset-password');
	}

	public function store(Request $request): RedirectResponse
	{
		$user = User::where('email', $request->email)->first();

		if (!$user) {
			return redirect()->back()->with('error', 'Email address not found.');
		}

		$existingToken = DB::table('password_reset_tokens')->where('email', $user->email)->first();

		if ($existingToken) {
			// Update the existing token with a new one
			$token = Str::random(60);
			DB::table('password_reset_tokens')
				->where('email', $user->email)
				->update(['token' => $token, 'created_at' => Carbon::now()]);
		} else {
			// Insert a new token
			$token = Str::random(60);
			DB::table('password_reset_tokens')->insert([
				'email'      => $user->email,
				'token'      => $token,
				'created_at' => Carbon::now(),
			]);
		}
		//		$token = route('email_verification_reset_password', ['token' => $token]);

		Mail::to($user)->send(new ResetPasswordMail($token));

		return redirect()->route('confirmation');
	}
}
