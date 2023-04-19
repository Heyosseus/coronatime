<?php

namespace App\Http\Controllers;

use App\Models\Country;

class CountryController extends Controller
{
	public function index()
	{
		$countries = Country::all();
		return view('country', compact('countries'));
	}
}
