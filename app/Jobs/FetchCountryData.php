<?php

namespace App\Jobs;

use App\Models\Country;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FetchCountryData implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 */
	public function __construct()
	{
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
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
