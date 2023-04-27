<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountryController extends Controller
{
	public function create()
	{
		$countries = Country::all();

		return view('home', compact('countries'));
	}

	public function index(Request $request): View
	{
		$sortBy = request('sort_by', 'location');
		$sortDirection = request('sort_order', 'asc');

		$newSortDirection = ($sortDirection === 'asc') ? 'desc' : 'asc';

		$query = Country::query();
		switch ($sortBy) {
			case 'location':
				$query->orderBy('location->en', $sortDirection);
				break;
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
				$query->orderBy('location->en', $sortDirection);
		}

		if (request('search')) {
			$searchTerm = '%' . ucfirst(request('search')) . '%';
			$query->where('location->en', 'LIKE', $searchTerm)
				->orWhere('location->ka', 'LIKE', $searchTerm);
		}

		$countries = $query->get();

		$locations = [];

		foreach ($countries as $country) {
			if ($country->location) {
				$locations[$country->code] = json_decode($country->location, true);
			}
		}

		return view('country', compact('countries', 'sortBy', 'sortDirection', 'newSortDirection', 'locations'));
	}
}
