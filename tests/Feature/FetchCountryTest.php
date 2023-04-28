<?php

namespace Tests\Feature;

use App\Console\Commands\FetchCountries;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Mockery;
use Tests\TestCase;

class FetchCountryTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	use RefreshDatabase;

	use MakesHttpRequests;

	public function test_if_command_exists()
	{
		$this->assertTrue(class_exists(FetchCountries::class));
	}

	protected function setUp(): void
	{
		parent::setUp();

		Http::fake([
			'https://devtest.ge/countries' => Http::response([
				['code' => 'us', 'name' => ['en' => 'United States', 'ka' => 'აშშ']],
			]),
		]);
	}

	public function test_if_it_fetches_countries_from_api_and_stores_in_database()
	{
		Http::fake([
			'https://devtest.ge/get-country-statistics' => Http::response([
				'code'      => 'us',
				'confirmed' => 100,
				'deaths'    => 10,
				'recovered' => 90,
			]),
		]);
		$this->artisan('fetch:countries')
			->expectsOutput('Countries fetched successfully!')
			->assertExitCode(0);

		$this->assertDatabaseHas('countries', [
			'code'      => 'us',
			'location'  => '{"en":"United States","ka":"\u10d0\u10e8\u10e8"}',
			'new_cases' => 100,
			'deaths'    => 10,
			'recovered' => 90,
		]);
	}

	public function test_if_it_handles_null_response_from_api_for_get_country_info()
	{
		Http::fake([
			'*' => Http::response([]),
		]);

		$this->assertNull($this->app->make('App\Console\Commands\FetchCountries')->getCountryInfo('unknown'));
	}

	public function test_it_handles_null_response_from_api_for_get_country_data()
	{
		$countryCode = 'zzzz';

		Http::fake([
			'https://devtest.ge/get-country-statistics' => Http::response([], 400),
		]);

		$result = $this->app->make('App\Console\Commands\FetchCountries')->getCountryData($countryCode);

		$this->assertNull($result);
	}

	protected function tearDown(): void
	{
		parent::tearDown();

		Mockery::close();
	}
}
