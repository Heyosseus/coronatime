<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\User;
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
		$this->validate($request, [
			'email' => 'required|email',
		]);

		$user = User::where('email', $request->email)->first();
		if (!$user) {
			return back()->with('failed', 'Failed! email is not registered.');
		}

		$token = Str::random(60);

		$user['token'] = $token;
		$user['is_verified'] = 0;
		$user->save();

		//		$token = DB::table('password_reset_tokens')->where('email', $user->email)->first();
		Mail::to($request->email)->send(new ResetPasswordMail($token));

		return redirect()->route('confirmation');
	}
}
