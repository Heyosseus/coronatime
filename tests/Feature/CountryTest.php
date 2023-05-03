<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	use RefreshDatabase;

	public function test_if_countries_data_is_successfully_retrieved_for_the_home_page()
	{
        $user = User::factory()->create();

        $this->actingAs($user);
		$response = $this->get(route('home'));
		$response->assertSuccessful();

		$response->assertViewIs('home');
		$response->assertViewHas('countries');

	}

	public function test_countries_are_retrieved_correctly()
	{
		$country1 = Country::factory()->create(['location' => json_encode(['en' => 'France', 'ka' => 'საფრანგეთი'])]);
		$country2 = Country::factory()->create(['location' => json_encode(['en' => 'United Kingdom', 'ka' => 'გაერთიანებული სამეფო'])]);

		$response = $this->get(route('countries'));

		$response->assertSuccessful();
		$response->assertViewIs('country');
		$response->assertViewHas('countries');
		$this->assertTrue($response->viewData('countries')->contains($country1));
		$this->assertTrue($response->viewData('countries')->contains($country2));
	}

	public function test_countries_are_sorted_correctly()
	{
		Country::factory()->create(['location' => json_encode(['en' => 'France', 'ka' => 'საფრანგეთი']), 'new_cases' => 100, 'recovered' => 50, 'deaths' => 10]);
		Country::factory()->create(['location' => json_encode(['en' => 'United Kingdom', 'ka' => 'გაერთიანებული სამეფო']), 'new_cases' => 200, 'recovered' => 70, 'deaths' => 20]);

		// Sort by new_cases in ascending order
		$response = $this->get(route('countries', ['sort_by' => 'new_cases', 'sort_order' => 'asc']));

		$response->assertOk();
		$response->assertViewIs('country');
		$response->assertViewHas('countries');
		$this->assertEquals(100, $response->viewData('countries')[0]->new_cases);
		$this->assertEquals(200, $response->viewData('countries')[1]->new_cases);

		// Sort by recovered in descending order
		$response = $this->get(route('countries', ['sort_by' => 'recovered', 'sort_order' => 'desc']));

		$response->assertOk();
		$response->assertViewIs('country');
		$response->assertViewHas('countries');
		$this->assertEquals(70, $response->viewData('countries')[0]->recovered);
		$this->assertEquals(50, $response->viewData('countries')[1]->recovered);

		// Sort by deaths in ascending order
		$response = $this->get(route('countries', ['sort_by' => 'deaths', 'sort_order' => 'asc']));

		$response->assertOk();
		$response->assertViewIs('country');
		$response->assertViewHas('countries');
		$this->assertEquals(10, $response->viewData('countries')[0]->deaths);
		$this->assertEquals(20, $response->viewData('countries')[1]->deaths);
	}

	public function test_if_uppercase_works_fine_in_search_field()
	{
		$searchTerm = 'france';

		$response = $this->get('/countries?search=' . $searchTerm);

		$response->assertSuccessful();

		$countries = $response->viewData('countries');

		foreach ($countries as $country) {
			$location = json_decode($country->location, true);
			$enLocation = strtoupper($location['en']);
			$kaLocation = strtoupper($location['ka']);

			$this->assertTrue(
				strpos($enLocation, strtoupper($searchTerm)) !== false
				|| strpos($kaLocation, strtoupper($searchTerm)) !== false,
				"Search term is not properly uppercased: '$searchTerm'"
			);
		}
	}

	public function test_if_default_search_case_works_fine()
	{
		$response = $this->get('/countries?sort_by=invalid_sort_field');

		$response->assertStatus(200);
		$response->assertViewHas('countries');

		$countries = $response->viewData('countries');

		// Check that the countries are sorted by location in ascending order
		$previousLocation = null;
		foreach ($countries as $country) {
			$location = $country->location['en'];
			if ($previousLocation !== null) {
				$this->assertGreaterThanOrEqual(0, strcmp($previousLocation, $location));
			}
			$previousLocation = $location;
		}
	}
}
