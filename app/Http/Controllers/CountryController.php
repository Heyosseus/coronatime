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
		$sortOrder = request('sort_order', 'asc');

		// Determine the new sort order to be used for the sorting buttons
		$newSortOrder = ($sortOrder === 'asc') ? 'desc' : 'asc';

		//		 Retrieve the countries from the database, sorted by the selected column and order
		$query = Country::query();
		switch ($sortBy) {
			case 'new_cases':
				$query->orderBy('new_cases', $sortOrder);
				break;
			case 'recovered':
				$query->orderBy('recovered', $sortOrder);
				break;
			case 'deaths':
				$query->orderBy('deaths', $sortOrder);
				break;
			default:
				$query->orderByRaw("JSON_UNQUOTE(JSON_EXTRACT(location, '$.en')) $sortOrder");
		}

		if (request('search')) {
			$searchTerm = '%' . request('search') . '%';
			$query->whereRaw("JSON_EXTRACT(location, '$.en') LIKE ?", [$searchTerm])
				->orWhereRaw("JSON_EXTRACT(location, '$.ka') LIKE ?", [$searchTerm]);
		}
		//		if (request('search')) {
		//			$searchTerm = '%' . request('search') . '%';
		//			$query->where('location->en', [$searchTerm])
		//				->orWhere('location->ka', [$searchTerm]);
		//		}

		$countries = $query->get();

		$locations = [];

		foreach ($countries as $country) {
			$locations[$country->code] = json_decode($country->location, true);
		}

		return view('country', compact('countries', 'sortBy', 'sortOrder', 'newSortOrder', 'locations'));
	}
}
