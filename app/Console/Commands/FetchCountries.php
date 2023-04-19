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

	public function handle()
	{
		$response = Http::get('https://devtest.ge/countries');
		if ($response->ok()) {
			$countries = $response->json();

			foreach ($countries as $country) {
				$code = $country['code'];
				$apiResponse = Http::post('https://devtest.ge/get-country-statistics', [
					'code' => $code,
				]);
				if ($apiResponse->ok()) {
					$countryData = $apiResponse->json();
					Country::create([
						'code'          => $countryData['code'],
						'location'      => $countryData['country'],
						'recovered'     => $countryData['recovered'],
						'deaths'        => $countryData['deaths'],
						'new_cases'     => $countryData['confirmed'],
					]);
				}
			}
		}
	}
}
