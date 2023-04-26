<?php

namespace Tests\Feature;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	public function test_if_user_can_successfully_visit_the_reset_password_page()
	{
		$response = $this->get('/reset-password');

		$response->assertSuccessful();
		$response->assertSee('Email');
		$response->assertViewIs('verification.reset-password');
	}

	public function test_if_user_can_successfully_visit_the_new_password_page()
	{
		$user = User::factory()->create(['is_verified' => false]);
		$token = Str::random(60);
		$user->token = $token;
		$user->save();
		$response = $this->get(route('new_password', ['token' => $token]));

		$response->assertSuccessful();
		$response->assertViewIs('verification.new-password');
	}

	public function test_if_users_email_is_valid()
	{
		$email = 'test@gmail.com';

		User::factory()->create([
			'email'     => $email,
		]);
		$this->assertDatabaseHas('users', [
			'email' => $email,
		]);

		User::where('email', 'test@gmail.com')->first();
	}

	public function test_if_it_shows_the_new_password_page_for_valid_token()
	{
		$user = User::factory()->create(['is_verified' => false]);
		$token = Str::random(60);
		$user->token = $token;
		$user->save();

		$response = $this->get(route('new_password', ['token' => $token]));

		$response->assertStatus(200);
		$response->assertViewIs('verification.new-password');
		//		$response->assertViewHas(['email' => $user->email, 'token' => $token]);
	}

	public function test_if_it_redirects_to_reset_password_page_for_invalid_token()
	{
		$invalidToken = 'invalid_token';

		$response = $this->get(route('new_password', ['token' => $invalidToken]));

		$response->assertRedirect(route('reset_password'));
		$response->assertSessionHas('failed', 'Password reset link is expired');
	}

	public function test_if_it_updates_password_for_valid_email()
	{
		$user = User::factory()->create();
		$newPassword = 'new_password';

		$response = $this->put(route('recovery_password'), [
			'email'                 => $user->email,
			'password'              => $newPassword,
			'password_confirmation' => $newPassword,
		]);

		$response->assertRedirect(route('confirmation_email'));

		$response->assertSessionHas('success', 'Success! password has been changed');

		$user = $user->fresh();
		$this->assertTrue(Hash::check($newPassword, $user->password));
	}

	public function test_if_it_redirects_to_reset_password_page_for_invalid_email()
	{
		$invalidEmail = 'invalid_email@example.com';
		$newPassword = 'new_password';

		$response = $this->put(route('recovery_password'), [
			'email'                 => $invalidEmail,
			'password'              => $newPassword,
			'password_confirmation' => $newPassword,
		]);

		$response->assertRedirect(route('reset_password'));
		$response->assertSessionHas('failed', 'Failed! something went wrong');
	}

	public function test_if_it_sends_password_reset_email_when_email_is_valid()
	{
		$user = User::factory()->create(['is_verified' => false]);

		// mock the ResetPasswordMail class
		Mail::fake();
		Mail::assertNothingSent();

		// call the store method with a request containing the user's email
		$response = $this->post('/reset-password', [
			'email' => $user->email,
		]);

		// assert that the user's token and is_verified field were updated
		$user->refresh();
		$this->assertNotNull($user->token);

		// assert that the ResetPasswordMail was sent to the user's email address
		Mail::assertSent(ResetPasswordMail::class, function ($mail) use ($user) {
			return $mail->hasTo($user->email);
		});

		// assert that the user was redirected to the confirmation route
		$response->assertRedirect(route('confirmation'));
	}

	public function test_if_it_does_not_send_password_reset_email_when_email_is_invalid()
	{
		Mail::fake();

		$response = $this->post(route('post_reset_password'), [
			'email' => 'r.ssadasdxxgmail.com',
		]);

		$response->assertSessionHasErrors('email');

		Mail::assertNotSent(ResetPasswordMail::class);
	}

	public function test_if_it_redirects_to_the_confirmation_page()
	{
		Mail::fake();

		$user = User::factory()->create();

		$response = $this->post(route('post_reset_password'), [
			'email' => $user->email,
		]);

		$response->assertRedirect(route('confirmation'));
	}
}
