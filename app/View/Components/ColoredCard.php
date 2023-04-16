<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ColoredCard extends Component
{
	public $colors;

	public function __construct($colors)
	{
		$this->colors = $colors;
	}

	public function render(): View
	{
		return view('components.colored-card');
	}
}
