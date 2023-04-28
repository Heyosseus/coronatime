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
		$sortBy = $request->input('sort_by', 'location');

		$sortDirection = $request->input('sort_order', 'asc') === 'asc' ? 'asc' : 'desc';

		$query = Country::query();
		$query->orderBy($request->sort_by ?? 'location->en', $sortDirection);

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

		return view('country', compact('countries', 'sortBy', 'sortDirection', 'locations'));
	}
}
