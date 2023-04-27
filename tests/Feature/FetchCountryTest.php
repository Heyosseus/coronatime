<?php

namespace Tests\Feature;

use App\Console\Commands\FetchCountries;
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

	public function test_if_command_exists()
	{
		$this->assertTrue(class_exists(FetchCountries::class));
	}

	protected function setUp(): void
	{
		parent::setUp();

		// Mock the API response for the /countries endpoint
		Http::fake([
			'https://devtest.ge/countries' => Http::response([
				['code' => 'us', 'name' => ['en' => 'United States', 'ka' => 'აშშ']],
			]),
		]);

		// Mock the API response for the /get-country-statistics endpoint
		Http::fake([
			'https://devtest.ge/get-country-statistics' => Http::response([
				'code'      => 'us',
				'confirmed' => 100,
				'deaths'    => 10,
				'recovered' => 90,
			]),
		]);
	}

	public function test_if_it_fetches_countries_from_api_and_stores_in_database()
	{
		// Call the fetch:countries command
		$this->artisan('fetch:countries')
			->expectsOutput('Countries fetched successfully!')
			->assertExitCode(0);

		// Verify that the countries were stored in the database
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
		$countryCode = 'ZZ'; // Invalid country code that the API might not recognize
		$mockHttp = Mockery::mock('overload:Http');
		$mockHttp->shouldReceive('post')->once()
			->with('https://devtest.ge/get-country-statistics', ['code' => $countryCode])
			->andReturnSelf();
		$mockHttp->shouldReceive('ok')->once()->andReturn(false);

		//		$this->assertNull($this->app->make('App\Console\Commands\FetchCountries')->getCountryData($countryCode));
	}

	protected function tearDown(): void
	{
		parent::tearDown();

		Mockery::close();
	}
}
