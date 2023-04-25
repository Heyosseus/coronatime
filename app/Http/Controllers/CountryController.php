<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
	public function create()
	{
		$countries = Country::all();

		return view('home', compact('countries'));
	}

	public function index(Request $request)
	{
		$sortBy = request('sort_by', 'location');
		$sortDirection = request('sort_order', 'asc');

		// Determine the new sort order to be used for the sorting buttons
		$newSortDirection = ($sortDirection === 'asc') ? 'desc' : 'asc';

		//		 Retrieve the countries from the database, sorted by the selected column and order
		$query = Country::query();
		switch ($sortBy) {
			case 'new_cases':
				$query->orderBy('new_cases', $sortDirection);
				break;
			case 'recovered':
				$query->orderBy('recovered', $sortDirection);
				break;
			case 'deaths':
				$query->orderBy('deaths', $sortDirection);
				break;
			default:
				$query->orderByRaw("JSON_UNQUOTE(JSON_EXTRACT(location, '$.en')) $sortDirection");
		}

		if (request('search')) {
			$searchTerm = '%' . ucfirst(request('search')) . '%';
			$query->where('location->en', 'LIKE', $searchTerm)
				->orWhere('location->ka', 'LIKE', $searchTerm);
		}

		$countries = $query->get();

		$locations = [];

		foreach ($countries as $country) {
			$locations[$country->code] = json_decode($country->location, true);
		}

		return view('country', compact('countries', 'sortBy', 'sortDirection', 'newSortDirection', 'locations'));
	}
}
