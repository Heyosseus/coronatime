<?php

namespace App\Http\Controllers;

use App\Models\Country;

class CountryController extends Controller
{
	public function index()
	{
		$countries = Country::latest()->get();
		if (request('search')) {
			$countries = Country::where('location', 'like', '%' . request('search') . '%')->get();
		}
		return view('country', compact('countries'));
	}
}
