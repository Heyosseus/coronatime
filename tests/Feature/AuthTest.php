<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class AuthTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	use RefreshDatabase;

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

	public function test_auth_should_return_name_errors_if_name_input_is_not_valid()
	{
		$response = $this->post('/login', [
			'name'     => 'te',
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
		$name = 'test11';
		$email = 'test11@gmail.com';
		$password = 'password';
		$password_confirmation = 'password';
		User::factory()->make([
			'name'     => $name,
			'email'    => $email,
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
			'email'     => $email,
			'password'  => bcrypt($password),
		]);
		$response = $this->post('/login', [
			'name'     => $email,
			'password' => $password,
		]);

		$this->assertTrue(Session::has('_token'));

		$response->assertRedirect(route('home'));
	}

	public function test_if_the_remember_device_checkbox_is_correctly_saved_to_database()
	{
		$this->post('/register', [
			'name'                  => 'rati',
			'email'                 => 'test@gmail.com',
			'password'              => 'password',
			'password_confirmation' => 'password',
			'remember_device'       => true,
		]);

		$this->assertDatabaseHas('users', [
			'email'           => 'test@gmail.com',
			'remember_device' => true,
		]);
	}

	public function test_if_the_password_is_correctly_hashed()
	{
		$this->post('/register', [
			'name'                  => 'rati',
			'email'                 => 'test@gmail.com',
			'password'              => 'password',
			'password_confirmation' => 'password',
		]);

		$this->assertDatabaseHas('users', [
			'email' => 'test@gmail.com',
		]);

		$user = User::where('email', 'test@gmail.com')->first();

		$this->assertTrue(Hash::check('password', $user->password));
	}

	public function test_if_user_is_not_directly_logged_in_after_registration()
	{
		$this->post('/register', [
			'name'                  => 'rati',
			'email'                 => 'test@gmail.com',
			'password'              => 'password',
			'password_confirmation' => 'password',
		]);

		$this->assertGuest();
	}

	public function test_if_user_can_logout()
	{
		$user = User::factory()->create();
		$this->actingAs($user);

		$response = $this->post(route('logout'));
		$response->assertRedirect(route('login'));
		$this->assertGuest();
	}
}
