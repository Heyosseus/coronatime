<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchCountries extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'fetch:countries';

	protected $description = 'Fetch country data from API and store in database';

	public function __construct()
	{
		parent::__construct();
	}

	public function getCountryData($code)
	{
		$apiResponse = Http::post('https://devtest.ge/get-country-statistics', [
			'code' => $code,
		]);

		if ($apiResponse->ok()) {
			return $apiResponse->json();
		}

		return null;
	}

	public function getCountryInfo($code)
	{
		$apiResponse = Http::get('https://devtest.ge/countries');

		if ($apiResponse->ok()) {
			$countries = $apiResponse->json();

			foreach ($countries as $country) {
				if ($country['code'] === $code) {
					return $country;
				}
			}
		}

		return null;
	}

	public function setCountryData($countryData): void
	{
		$countryInfo = $this->getCountryInfo($countryData['code']);

		if ($countryInfo) {
			Country::updateOrCreate([
				'code' => $countryData['code'],
			], [
				'location' => json_encode([
					'en' => $countryInfo['name']['en'],
					'ka' => $countryInfo['name']['ka'],
				]),
				'recovered' => $countryData['recovered'],
				'deaths'    => $countryData['deaths'],
				'new_cases' => $countryData['confirmed'],
			]);
		}
	}

		public function handle(): void
		{
			$response = Http::get('https://devtest.ge/countries');
			if ($response->ok()) {
				$countries = $response->json();

				foreach ($countries as $country) {
					$countryData = $this->getCountryData($country['code']);
					if ($countryData) {
						$this->setCountryData($countryData);
					}
				}
			}
			$this->line('Countries fetched successfully!');
		}
}
