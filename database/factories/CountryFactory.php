<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	protected $model = Country::class;

	public function definition()
	{
		return [
			'code'     => $this->faker->countryCode(),
			'location' => json_encode([
				'en' => $this->faker->country(),
				'ka' => $this->faker->country(),
			]),
			'recovered' => $this->faker->numberBetween(0, 1000),
			'deaths'    => $this->faker->numberBetween(0, 1000),
			'new_cases' => $this->faker->numberBetween(0, 1000),
		];
	}
}
