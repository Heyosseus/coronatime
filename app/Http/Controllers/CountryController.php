<?php

namespace App\Http\Controllers;

use App\Models\Country;

class CountryController extends Controller
{
	public function create()
	{
		$countries = Country::all();

		return view('home', compact('countries'));
	}

	public function index()
	{
		$sortBy = request('sort_by', 'location');
		$sortOrder = request('sort_order', 'asc');

		// Determine the new sort order to be used for the sorting buttons
		$newSortOrder = ($sortOrder === 'asc') ? 'desc' : 'asc';

		// Retrieve the countries from the database, sorted by the selected column and order
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
				$query->orderBy('location', $sortOrder);
		}
		if (request('search')) {
			$query->where('location', 'like', '%' . request('search') . '%');
		}
		$countries = $query->get();

		// Pass the data to the view
		return view('country', compact('countries', 'sortBy', 'sortOrder', 'newSortOrder'));
	}
}
