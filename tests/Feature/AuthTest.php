<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	//	use RefreshDatabase;

	public function test_login_page_is_accessible()
	{
		$response = $this->get('/login');

		$response->assertSuccessful();
		$response->assertSee('login');
		$response->assertViewIs('auth.login');
	}

	public function test_register_page_is_accessible()
	{
		$response = $this->get('/register');
		$response->assertSuccessful();
		$response->assertSee('register');
		$response->assertViewIs('auth.register');
	}

	public function test_auth_should_return_errors_if_inputs_are_not_provided()
	{
		$response = $this->post('/login');
		$response->assertSessionHasErrors(['name', 'password']);
	}

	public function test_auth_should_return_email_errors_if_email_input_is_not_provided()
	{
		$response = $this->post('/login', [
			'password' => 'password',
		]);
		$response->assertSessionHasErrors(['name']);
		$response->assertSessionDoesntHaveErrors(['password']);
	}

	public function test_auth_should_return_password_errors_if_password_input_is_not_provided()
	{
		$response = $this->post('/login', [
			'name' => 'test@gmail.com',
		]);
		$response->assertSessionHasErrors(['password']);
		$response->assertSessionDoesntHaveErrors(['name']);
	}

	public function test_auth_should_return_email_errors_if_email_input_is_not_valid()
	{
		$response = $this->post('/login', [
			'email'     => 'testgmail.com',
		]);

		$response->assertSessionHasErrors(['name', 'password']);
	}

	public function test_auth_should_return_password_errors_if_password_input_is_not_valid()
	{
		$response = $this->post('/login', [
			'password' => 'ps',
		]);

		$response->assertSessionHasErrors('name');
	}

	public function test_auth_should_return_invalid_credentials_errors_if_user_doesnt_exist()
	{
		$response = $this->post('/login', [
			'name'     => 'rati',
			'password' => 'password',
		]);

		$response->assertSessionHasErrors('name');
	}

	public function test_auth_should_redirect_to_login_page_when_user_is_registered()
	{
		$name = 'test';
		$email = 'test@gmail.com';
		$password = 'password';
		$password_confirmation = 'password';
		User::factory()->create([
			'name'     => $email,
			'password' => bcrypt($password),
		]);
		$response = $this->post('/register', [
			'name'                  => $name,
			'email'                 => $email,
			'password'              => $password,
			'password_confirmation' => $password_confirmation,
		]);
		$response->assertRedirect('/login');
	}

	public function test_auth_should_redirect_to_home_page_when_user_successfully_logs_in()
	{
		$email = 'test@gmail.com';
		$password = 'password';
		User::factory()->create([
			'name'     => $email,
			'password' => bcrypt($password),
		]);
		$response = $this->post('/login', [
			'name'     => $email,
			'password' => $password,
		]);
		$response->assertRedirect('/');
	}
}
