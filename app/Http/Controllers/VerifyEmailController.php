<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVerifyEmailRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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

	public function store(StoreVerifyEmailRequest $request): RedirectResponse
	{
		$user = User::where('email', $request->email)->first();
		if (!$user) {
			return back()->withErrors(['failed' => 'Failed! email is not registered.']);
		}

		$token = Str::random(60);

		$user->update([
			'token'       => $token,
			'is_verified' => 0,
		]);

		//		$token = DB::table('password_reset_tokens')->where('email', $user->email)->first();
		Mail::to($request->email)->send(new ResetPasswordMail($token));

		return redirect()->route('confirmation');
	}
}
