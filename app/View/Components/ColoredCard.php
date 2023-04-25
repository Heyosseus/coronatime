<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ColoredCard extends Component
{
	public $color;

	public function __construct($color)
	{
		$this->color = $color;
	}

	public function render(): View
	{
		return view('components.colored-card');
	}
}
