<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 */
	public function __construct($token)
	{
		$this->token = $token;
	}

	public function build(): Mailable
	{
		$token = route('email_verification_reset_password', ['token' => $this->token]);

		return $this->view('emails.confirm-reset-password')
			->subject('Reset your password')
			->with(['token' => $this->token]);
	}
}
